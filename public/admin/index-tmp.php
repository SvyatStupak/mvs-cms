<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT', 'qsHHH333kKkdf');

include_once ROOT_PATH . 'src/DataBaseConnection.php';
include_once ROOT_PATH . 'src/Entity.php';
include_once ROOT_PATH . 'src/Router.php';
include_once ROOT_PATH . 'src/Auth.php';
include_once MODULES_PATH . 'user/models/User.php';

DataBaseConnection::connect('localhost', 'my_cms', 'root', 'root');

$dbh = DataBaseConnection::getInstance();
$dbc = $dbh->getConnection();

$userObj = new User($dbc);

$userObj->findBy('username', 'admin');

$authObj = new Auth();

$userObj = $authObj->changeUserPassword($userObj, 'TopSecret');

echo '<pre>';
var_dump($userObj);
echo '</pre>';
