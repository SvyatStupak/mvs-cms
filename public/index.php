<?php
session_start();

use src\DataBaseConnection;
use src\Router;
use src\Template;

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);


spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();


$section = $_GET['seo_name'] ?? $_POST['seo_name'] ?? 'home';

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);
$router->findBy('pretty_url', $section);

$action = $router->action !== '' ? $router->action : 'default';

$nameController = '\modules\\' . $router->module . '\controllers\\' . ucfirst($router->module) . 'Controller';

if(class_exists($nameController))
{
    $controller = new $nameController();

    $controller->dbc = $dbc;

    $controller->template = new Template('layout/default');

    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}
