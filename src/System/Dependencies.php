<?php declare(strict_types = 1);


$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
	':get' => $_GET,
	':post' => $_POST,
	':cookies' => $_COOKIE,
	':files' => $_FILES,
	':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

//$injector->alias('DebugBar\StandardDebugBar', 'DebugBar\StandardDebugBar');
//$injector->share('DebugBar\StandardDebugBar');


$injector->alias('App\Menu\MenuReader', 'App\Menu\ArrayMenuReader');
$injector->share('App\Menu\ArrayMenuReader');

$injector->alias('App', 'App\System\App');

$app = $injector->make("App");
$injector->share($app);

$injector->share(new \App\Utils\Router());

return $injector;
