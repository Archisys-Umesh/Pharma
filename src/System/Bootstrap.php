<?php declare(strict_types = 1);

//namespace App;
error_reporting(E_ALL);


require __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../..");
$dotenv->safeLoad();

if(!isset($_ENV['dsn']))
{
    echo "Enviroment Configuration are missing, Please check setup !!";
    exit;
}

$environment = $_ENV['environment'];
//$debug = false;
date_default_timezone_set('Asia/Kolkata');
/**
 * Register the error handler
 */

$isAjax = false;
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { $isAjax = true; }
if(strpos($_SERVER['REQUEST_URI'], 'api') !== false){ $isAjax = true; }

$whoops = new \Whoops\Run;

if($isAjax)
{
    $jrh = new \Whoops\Handler\JsonResponseHandler();
    if ($environment == 'development') {   $jrh->addTraceToOutput(false); }
    $whoops->pushHandler($jrh); 
}
else if ($environment == 'development') {  
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);     
} 
else {
	$whoops->pushHandler(function($e) {
		//echo 'Todo: Friendly error page and send an email to the developer';
        // set the format
        $output = "%message%";
        $formatter = new LineFormatter($output);
        // create a log channel to STDOUT
        $log = new Logger('TSPC_ALEMBIC');
        $streamHandler = new StreamHandler('php://stdout', Logger::WARNING);
        $streamHandler->setFormatter($formatter);
        $log->pushHandler($streamHandler);
    });
}
$whoops->register();



require_once __DIR__ . '/../../database.php';
require_once __DIR__ . '/../Config.php';
require_once __DIR__ . '/../AppConfig.php';


// ALL PUT to POST
$PUT = (array) json_decode(file_get_contents("php://input"));
$_POST = array_merge($_POST,$PUT);

$injector = include('Dependencies.php');


// if($debug) {
//     $debugBar = $injector->make(\DebugBar\StandardDebugBar::class);
//     $debugBar['time']->startMeasure('init', 'blackEagle :: Start, Injection & Set Routes');          
// }

$GLOBALS['injector'] = $injector; // Global use





$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

if(str_contains(strtolower($request->getPath()),'api'))
{
    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler); 
}

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
        
	$routes = \App\Utils\Router::getRoutes();                
        
        foreach ($routes as $route) {
		$r->addRoute($route[0], $route[1], $route[2]);        
	}
        
};
// if($debug) {
//     $debugBar['time']->stopMeasure('init');
//     $debugBar['time']->startMeasure('Controller',"Match Route and Controller");
// }

if (extension_loaded ('newrelic')) {
    newrelic_name_transaction ($request->getPath());
}

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch($routeInfo[0]) {
	case \FastRoute\Dispatcher::NOT_FOUND:          
                $path = $request->getPath();                
                if(!strpos($path,"api")){
                   // $response->setContent($renderer->render("logout",[],false)); 		
                    $response->setContent("Logout");                    
                }
                else
                {
                    $response->setHeader("Content-Type", "application/json");
                    $response->setContent(json_encode(["statusCode" => "500","message"=>"You do not have permissions or login from another device."]));
                }
                
                 
                $response->setStatusCode(404);
		break;
	case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$response->setContent('405 - Method not allowed, Check your Routes');
		$response->setStatusCode(405);
		break;
	case \FastRoute\Dispatcher::FOUND:
		$className = $routeInfo[1][0];
		$method = $routeInfo[1][1];
		$vars = $routeInfo[2];

		$class = $injector->make($className);		
                call_user_func_array(array($class, $method), $vars);
		break;
}

//if($debug) { $debugBar['time']->stopMeasure('Controller');}

foreach ($response->getHeaders() as $header) { 
    
    if($header == "Content-Type: text/html; charset=UTF-8") { $debug = true; }
    
    header($header, false); 
    
}
//if($debug && $isAjax) { $debugBar->sendDataInHeaders(); }

////
echo $response->getContent();
////

// if($debug && !$isAjax) {    
//     $debugbarRenderer = $debugBar->getJavascriptRenderer();
//     echo $debugbarRenderer->setBaseUrl(\App\Utils\Router::baseUrl('debugBar'))->renderHead();
//     echo $debugbarRenderer->render();    
// }


