<?php

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('default', 'pgsql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle('default');
$manager->setConfiguration(array(
    'dsn' => $_ENV['dsn'],
    'user' => $_ENV['user'],
    'password' => $_ENV['password'],
    'settings' =>
    array(
        'charset' => 'utf8',
        'queries' =>
        array(
        ),
    ),
    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
    'model_paths' =>
        array (
            0 => 'src',
            1 => 'vendor',
        ),
));
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('default');
$serviceContainer->getConnection("default")->exec("SET TIMEZONE TO 'Asia/Calcutta';");
require_once __DIR__ . '/loadDatabase.php';
