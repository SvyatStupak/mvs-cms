<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);

include_once ROOT_PATH . 'src/Controller.php';
include_once ROOT_PATH . 'src/Template.php';

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($section === 'about-us') {
    
    include ROOT_PATH . 'controller/AboutUsPage.php';
    $aboutUsController = new AboutUsPage();
    $aboutUsController->runAction($action);
} else if ($section === 'contact') {

    include ROOT_PATH . 'controller/ContactPage.php';
    $contactController = new ContactController();
    $contactController->runAction($action);

} else {

    include ROOT_PATH . 'controller/HomePage.php';

    $homePageController = new HomePage();
    $homePageController->runAction($action);
}
