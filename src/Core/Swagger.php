<?php declare(strict_types = 1);
namespace App\Core;

use App\System\App;
use Http\Request;


class Swagger extends BaseController
{
    protected $app;
    
    public function __construct(App $app) {
        $this->app = $app;         
    }
    
    /**
    * @OA\Info(
     * title="SalesKraft API Doc", 
     * version="0.1",
     * description = "API Documentation for Mobile App and Integration",
     * 
     * )
     * 
    */
    
    public function index()
    {
        
        $module_controllers = array(__DIR__);
        $dir = __DIR__.'/../../modules';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){
            if(is_dir($dir."/$file") && $file != "." && $file != "..") 
            {      
                $controllerFolder = $dir."/$file/Controllers/";
                
                if(is_dir($controllerFolder)) {
                    array_push($module_controllers,$controllerFolder);
                }
            }                
        }
        
        $openapi = \OpenApi\Generator::scan($module_controllers);
        

        file_put_contents("swagger.yaml",$openapi->toYaml());

        //$this->app->Response()->setHeader('Content-Type','application/x-yaml');
        //$this->app->Response()->setContent($openapi->toYaml());
    
    }    
    
    public function UI()
    {        
        // Generate Swagger YML
        if($_ENV['isDevSystem'] == "true")
        {
            $this->index();
        }
        $this->app->Renderer()->render('swagger\index.twig', $this->data);                        
    }
    
}