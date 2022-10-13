<?php
session_start();

use src\DataBaseConnection;
use src\Router;
use src\Template;
use modules\page\admin\controllers\PageController;

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

// include_once ROOT_PATH . 'src/Controller.php';
// include_once ROOT_PATH . 'src/Template.php';
// include_once ROOT_PATH . 'src/DataBaseConnection.php';
// include_once ROOT_PATH . 'src/Entity.php';
// include_once ROOT_PATH . 'src/Router.php';
// include_once ROOT_PATH . 'src/Auth.php';
// include_once MODULE_PATH . 'user/models/User.php';
// include_once MODULE_PATH . 'page/models/Page.php';

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

$nameController = ucfirst($router->module) . 'Controller';

$controllerFile = MODULE_PATH . $router->module . '/controllers/' . $nameController . '.php';

if(file_exists($controllerFile))
{
    // include_once $controllerFile;

    $controller = new $nameController();

    $controller->dbc = $dbc;

    $controller->template = new Template('layout/default');

    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}
