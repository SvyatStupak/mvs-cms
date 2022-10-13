<?php
session_start();

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use src\DataBaseConnection;
use src\Template;
use modules\dashboard\admin\controllers\DashboardController;
use \modules\page\admin\controllers\PageController;

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT', 'qsHHH333kKkdf');

spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

require '../../vendor/autoload.php';


DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($module == 'dashboard') {

    // include MODULES_PATH . 'dashboard/admin/controllers/DashboardController.php';

    $dashboardController = new DashboardController();
    $dashboardController->template = $dbc;
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
} elseif ($module = 'page') {
    // include MODULES_PATH . 'page/admin/controllers/PageController.php';

    $log = new Logger('name');
    // $log->pushHandler(new StreamHandler('pages.log', Level::Warning));

    $pageController = new PageController();
    // $pageController->log = $log;
    $pageController->dbc = $dbc;
    $pageController->template = new Template('admin/layout/default');
    $pageController->runAction($action);
}
