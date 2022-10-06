<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT', 'qsHHH333kKkdf');

include_once ROOT_PATH . 'src/Controller.php';
include_once ROOT_PATH . 'src/Template.php';
include_once ROOT_PATH . 'src/DataBaseConnection.php';
include_once ROOT_PATH . 'src/Entity.php';
include_once ROOT_PATH . 'src/Router.php';
include_once ROOT_PATH . 'src/Auth.php';
include_once ROOT_PATH . 'src/interfaces/ValidationRulesInterface.php';
include_once ROOT_PATH . 'src/Validation.php';
include_once ROOT_PATH . 'src/validationRules/ValidateEmeil.php';
include_once ROOT_PATH . 'src/validationRules/ValidateMaximum.php';
include_once ROOT_PATH . 'src/validationRules/ValidateMinimum.php';
include_once ROOT_PATH . 'src/validationRules/ValidateSpecialCharacter.php';
include_once ROOT_PATH . 'src/validationRules/ValidateNoEmptySpaces.php';
include_once MODULES_PATH . 'page/models/Page.php';
include_once MODULES_PATH . 'user/models/User.php';

DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');



$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($module == 'dashboard') {
    
    include MODULES_PATH . 'dashboard/admin/controllers/DashboardController.php';
    
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    
} elseif ($module = 'page') {
    include MODULES_PATH . 'page/admin/controllers/PageController.php';
    
    $pageController = new PageController();
    $pageController->template = new Template('admin/layout/default');
    $pageController->runAction($action); 
}

