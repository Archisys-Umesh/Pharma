<?php declare(strict_types = 1);

namespace App\Core;

class BaseController
{    
    var $data = array();
                   
    public function __remap()
        {
            $paths = explode("/", $_SERVER['PATH_INFO']);
            
            $func = $paths[2];
            
            if(count($paths) == 3)
            {                
                $this->$func();
            }
            else if(count($paths) == 4)
            {
                $this->$func($paths[3]);
            }
            
        }
    public function json(array $data)
    {
                
        $this->app->Response()->setHeader("Content-Type", "application/json");                
        $this->app->Response()->setContent(json_encode($data));
        
    }
    
    public function apiResponse(array $data, int $statusCode, string $message)
    {
        $payload = [
            "data" => $data,
            "statusCode" => $statusCode,
            "message" => $message,
            "timestamp" => new \DateTime()            
        ];
        
        $this->json($payload);
    }
    public function isAjax() : bool
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        else if(isset($_GET['ajaxDebug']))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    
    public function getUser() : \entities\Users
    {
        return $this->app->Auth()->getUser();
    }
    
    public function runModalScript($js)
    {
        $this->json(array('js' => $js));
    }
    
    public function runModalRedirect($url)
    {
        $this->json(array('redirect' => $url));
    }
    public function closeModalWithToast($toast,$func="")
    {
        $this->json(array('toast' => $toast, 'func' => $func));
    }
    protected function closeModal()
    {
        $this->app->Response()->setContent("");
    }
    
    public function getConfig($module,$key = "", $companyId = '', $orgUnitId = '')
    {
        $config = [];
        if(!isset($GLOBALS['config'])) {
            $dir = __DIR__.'/../../modules';
            $dh = opendir($dir);
            while (($file = readdir($dh)) !== false){
                if(is_dir($dir."/$file") && $file != "." && $file != "..") 
                {           
                    if(file_exists($dir."/$file/Config.php")) {
                        $config = array_merge($config,array($file => include($dir."/$file/Config.php")));
                    }
                }                
            }
            // $DataConfigs = \entities\SystemConfigsQuery::create()
            //                     ->filterByCompanyId($this->auth->getUser()->getCompanyId())
            //                     ->filterByOrgunitId($this->auth->getUser()->getEmployee()->getOrgUnitId())
            //                     ->_or()
            //                     ->filterByOrgunitId(null,Criteria::EQUAL)
            //                     ->find()->toKeyValue('ConfigKey','ConfigOptions');

            // $data = [];
            // if(!empty($DataConfigs)){
            //     foreach($DataConfigs as $key => $value){
            //         if (!array_key_exists($key,$data)){
            //             $data[$key] = [];
            //         }
            //     }
            // }

            // foreach($DataConfigs as $key => $value){
            //     if (array_key_exists($key,$data)){
            //         $valExpos = explode(',',$value);
            //         foreach($valExpos as $valExpo){
            //             $data[$key] +=[$valExpo => $valExpo];
            //         }
            //     }
            // }

            try {
                $redisClient = new \Predis\Client($_ENV['REDIS_URL']."?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
                if($redisClient->exists('SystemConfigs')) {
                    $data = json_decode($redisClient->get('SystemConfigs'), true);
                }
            } catch(\Exception $e) {
                // radis url wrong
            }
            
            if (empty($data)) {
                $configs = \entities\SystemConfigsQuery::create()
                                ->find()
                                ->toArray();
        
                $data = [];                 
                foreach ($configs as $conf) {
                    $key = $conf['ModuleName'] . $conf['ConfigKey'] . '_' . $conf['CompanyId'];
                    if (!empty($conf['OrgunitId'])) {
                        $key = $key . '_' . $conf['OrgunitId'];
                    }
                    $data[$key] = $conf['ConfigValue'];
                }
            }

            $result = array_merge($config,$data);
            $GLOBALS['config'] = $result;
        }
        else 
        {
            $config = $GLOBALS['config'];
        }
        
        if($key != "") {
            if(isset($config[$module][$key]))
            {
                return $config[$module][$key];
            }else if (isset($config[$key])){
                return $config[$key];
            }
            else 
            {
                $systemKey = $module . '_' . $key . '_' . $companyId;
                if (!empty($orgUnitId)) {
                    $systemKey = $systemKey . '_' . $orgUnitId;
                }

                if (isset($config[$systemKey])) {
                    return $config[$systemKey];
                } else {
                    throw new \Exception("Error config keys not Found : $module : $key");
                }
            }
        }
        else 
        {
            return $config[$module];
        }
        
    }    
    
    function Validate($validation,$errorMsg,$field)
    {
        if(!$validation)
        {
            $exception = new \App\Exceptions\InputFieldValidationException($errorMsg,400,null,$field);
            throw $exception;
        }
    }

    function download_array_csv($array,$filename)
    {

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');                                    
        $f = fopen('php://output', 'w');
    
        fputcsv($f,array_keys($array[0]), ",");

        foreach ($array as $line) {
            fputcsv($f, $line, ",");
        }
    }

    function DTFilters($request){
        $filters = array(
            'draw' => isset($request['draw']) ? $request['draw'] : 1,
            'offset' => isset($request['start']) ? $request['start'] : 0,
            'limit' => isset($request['length']) ? $request['length'] : 25,
            'sortColumn' => (isset($request['order'][0]['column']) && isset($request['columns'][$request['order'][0]['column']]['data'])) ? $request['columns'][$request['order'][0]['column']]['data'] : 'created_at',   
            'sortOrder' => isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC',
            'search' => isset($request['search']['value']) ? $request['search']['value'] : '' 

        );
        // print_r($filters);
        // exit;
        return $filters;
    }
}