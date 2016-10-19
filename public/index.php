<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define("APP_PATH", realpath(dirname(__FILE__) . '/../'));
$app = new Yaf_Application(APP_PATH . '/config/app.ini');
$app->bootstrap()->run();

?>
