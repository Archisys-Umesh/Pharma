<?php
namespace App\System;

use Http\Response;
use Http\Request;
use App\Template\FrontendRenderer;

use Aura\Session\SessionFactory;
use Aura\Session\Segment;
use App\Utils\Auth;
use App\Menu\MenuReader;
//use DebugBar\StandardDebugBar;
use App\Utils\Router;
use Upload\Storage\FileSystem;


use Phpfastcache\Helper\Psr16Adapter;

class App
{
    /*@var $response Response*/
    protected $response;
    
    /*@var $request Request*/
    protected $request;        
    
    /*@var $renderer FrontendRenderer*/    
    protected $renderer;
    
    /*@var $session Segment*/
    protected $session;
    /*@var $auth Auth*/
    protected $auth;
    
    protected $router;
    
    protected $debug;
    
    protected $storage;
       
    protected $logger;
    
    protected $InstanceCache;

    public function __construct(Request $request, Response $response,Router $router)
	{
        
                $session_factory = new SessionFactory;                
                $session = $session_factory->newInstance($_COOKIE)->getSegment(_SESSIONKEY);
                        
		        $this->request = $request;
		        $this->response = $response;

                $this->auth = new Auth($session);		
                $this->session = $session;
                
                $this->router = $router;
                
                
                //$this->logger = new \Monolog\Logger(_SESSIONKEY);
                //$logFilename = date('dMY');
                
                //$this->logger->pushHandler(
                        //new \Monolog\Handler\StreamHandler(__DIR__."/../../log/".$logFilename.".log")
                //);
                
                $this->renderer = new \App\Core\Renderer($request,$response,$this->auth,$router);                
                
                
                $urls = [];
                foreach ($router->getRoutes() as $route) {                    
                    $urls[implode("|", $route[3])] = $route[1]. "  |  " .implode(":",$route[2]);
                }                                                                    
                
                
                //$twigProfiler = new \Twig\Profiler\Profile();
                //$this->renderer->getTwigEnv()->addExtension( new ProfilerExtension( $twigProfiler ) );
                //$debug->addCollector( new \DebugBar\Bridge\TwigProfileCollector( $twigProfiler ) );


                $path = __DIR__.'/../../'._UPLOADS."/unknown/";                
                
                if($this->auth->isLogin())
                {
                    $path = __DIR__.'/../../'._UPLOADS."/".$this->auth->getUser()->getCompanyId()."/";                                        
                }
                
                if(!is_dir($path)) { mkdir($path,0777,true);}                
                $this->storage = new \Upload\Storage\FileSystem($path);
                
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
                    //                             ->find()->toArray();
                    // $data = [];
                    // if(!empty($DataConfigs)){
                    //     foreach($DataConfigs as $DataConfig){
                    //         if($DataConfig['ConfigValue'] == null){
                    //             $configValue = $DataConfig['ConfigDefault'];
                    //         }else{
                    //             $configValue = $DataConfig['ConfigValue'];
                    //         }

                    //         if (!array_key_exists($DataConfig['ModuleName'],$data)){
                    //             $data[$DataConfig['ModuleName']] = [];
                    //         }
                    //         if (array_key_exists($DataConfig['ModuleName'],$data)){
                    //             array_push($data[$DataConfig['ModuleName']],[$DataConfig['ConfigKey'] => $configValue]);
                    //         }
                    //     }
                    // }

                    // $result = array_merge($config,$data);
                    //var_dump($result);exit;

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
                
                                
                $this->InstanceCache =  new Psr16Adapter('Files');                
	}
    
    public function logger() : \Monolog\Logger
    {
        return $this->logger;
    }

    public function Request() : Request
    {
        return $this->request;
    }
    
    public function Response() : Response
    {
        return $this->response;
    }
    public function Renderer() : \App\Core\Renderer
    {
        return $this->renderer;
    }
    
    public function Session() : Segment
    {
        return $this->session;
    }
    
    public function Auth() : Auth
    {
        return $this->auth;
    }
    
    public function isPost() : bool
    {
        return $this->request->getMethod() == "POST";
    }
    
    public function Router() : Router
    {
        return $this->router;
    }
    
    public function Debug($obj) 
    {
        return $this->debug["messages"]->addMessage($obj);
    }
    
    public function DebugCatchException(\Exception $e)
    {
        return $this->debug['exceptions']->addException($e);
    }
    
    public function Storage() : \Upload\Storage\FileSystem
    {
        return $this->storage;
    }
    
    public function Cache() : Psr16Adapter
    {
        return $this->InstanceCache;
    }
    
}