<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;

// Define paths
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Registra autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

$container = new FactoryDefault();

//
$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

//registra url base
$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($container);


//parte tutorial não funciona
// try {
//     // lida com requisiçôes
//     $response = $application->handle($_GET['_url'] ?? '/')->getContent();

//     $response->send();
// } catch (\Exception $e) {
//     echo 'Exception: ', $e->getMessage();
// }

//bando de dados
$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host'     => '127.0.0.1',
                'username' => 'root',
                'password' => '',
                'dbname'   => 'phalcontest',
            ]
        );
    }
);

//solução
echo $application->handle($_GET['_url'] ?? '/')->getContent();
?>