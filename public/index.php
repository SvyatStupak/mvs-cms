<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

include_once ROOT_PATH . 'src/Controller.php';
include_once ROOT_PATH . 'src/Template.php';
include_once ROOT_PATH . 'src/DataBaseConnection.php';
include_once ROOT_PATH . 'src/Entity.php';
include_once ROOT_PATH . 'src/Router.php';
include_once ROOT_PATH . 'src/Validation.php';
include_once MODULES_PATH . 'page/models/Page.php';
include_once MODULES_PATH . 'user/models/User.php';

DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');

// $section = $_GET['section'] ?? $_POST['section'] ?? 'home';
// $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

$action = $_GET['seo_name'] ?? $_POST['seo_name'] ?? 'home';

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();


$router = new Router($dbc);
$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';

$controllerName = ucfirst($router->module) . 'Controller';

$controllerFile = MODULES_PATH . $router->module . '/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    include $controllerFile;

    $controller = new $controllerName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}

