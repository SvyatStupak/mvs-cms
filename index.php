<?php

include_once 'src/Controller.php';

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($section === 'about-us') {
    
    include 'controller/AboutUsPage.php';
    $aboutUsController = new AboutUsPage();
    $aboutUsController->runAction($action);
} else if ($section === 'contact') {

    include 'controller/ContactPage.php';
    $contactController = new ContactController();
    $contactController->runAction($action);

} else {

    include 'controller/HomePage.php';
}
