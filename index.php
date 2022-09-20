<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);

include_once ROOT_PATH . 'src/Controller.php';
include_once ROOT_PATH . 'src/Template.php';
include_once ROOT_PATH . 'src/DataBaseConnection.php';
include_once ROOT_PATH . 'src/Entity.php';
include_once ROOT_PATH . 'src/Router.php';
include_once ROOT_PATH . 'model/Page.php';

DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');

// $section = $_GET['section'] ?? $_POST['section'] ?? 'home';
// $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

$action = $_GET['seo_name'] ?? 'home';

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();


$router = new Router($dbc);
$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';

$moduleName = ucfirst($router->module) . 'Controller';

if (file_exists(ROOT_PATH . 'controller/' . $moduleName . '.php')) {
    include 'controller/' . $moduleName . '.php';

    $controller = new $moduleName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}

