<?php declare(strict_types = 1);

namespace Modules\Monitoring\Controllers;

use App\System\App;
use Modules\Monitoring\Interfaces\MonitoringQueriesInterface;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Masters extends \App\Core\BaseController{
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;               
    }

    public function index(){
        $action = $this->app->Request()->getParameter("action");
        switch ($action) :
            case "":
                $tables = $this->getTables();
                $this->data['title'] = "Monitoring";
                $this->data['tables'] = $tables;
                $this->app->Renderer()->render("monitoring.twig", $this->data);
                break;
            
            case "list":
                $data = $this->getTableData($this->app->Request()->getParameter("key"));
                $response = [];
                $count = count($data);
                // $response["recordsTotal"] = $count;
                // $response["recordsFiltered"] = $count;
                $response['data'] = $data;
                $this->json($response);
        endswitch;
        
    }

    public function getTables() {
        $response = [];
        $dir = __DIR__.'/../Queries';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){

            if(!is_dir($dir."/$file") && $file != "." && $file != "..") 
            {
                try{

                    $className = explode(".",$file);
                    $path = "Modules\Monitoring\Queries\\".$className[0];                        

                    $class = new \ReflectionClass($path);
                    $this->getTable($class->newInstance(), $response);                                                                                                                            

                }
                catch(\Exception $e)
                {
                    $this->json(["error" => $e->getMessage()]);
                    var_dump($e->getMessage());exit;
                }
            }

        }

        return $response;
    }

    public function getTableData($key) {
        $response = [];
        $file = __DIR__.'/../Queries/'.$key.'.php';
        if(is_file($file)) 
        {
            try{
                $path = "Modules\Monitoring\Queries\\".$key;

                $class = new \ReflectionClass($path);
                return $this->getQueryTable($class->newInstance(), $response);
            }
            catch(\Exception $e)
            {
                $this->json(["error" => $e->getMessage()]);
                var_dump($e->getMessage());exit;
            }
        }
        return $response;
    }

    public function getTable(MonitoringQueriesInterface $interface,&$response)
    {
        if($interface->canRun())
        {
            $label = $interface->getLabel();
            $key = $interface->getUniqueKey();
            $columns = $interface->getTableColumns();
            $data = [['label' => $label, 'key' => $key, 'columns' => $columns]];
            $response = array_merge($response,$data);
        }
        
    }

    public function getQueryTable(MonitoringQueriesInterface $interface)
    {
        $data = [];
        if($interface->canRun())
        {
            $result = $interface->getData()->toArray();
            foreach($result as $row) {
                $data[] = array_values($row);
            }
        }
        return $data;
    }
}