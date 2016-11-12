<?php
/**
 * Created by PhpStorm.
 * User: fokke
 * Date: 11/12/16
 * Time: 6:39 PM
 */
require ("class.main.php");
require("class.application.php");

$dbuser = "";
$dbpass = "";
$dbmain = "";

$session = empty($_GET['session']) ? "" : $_GET['session'];
$company = empty($_GET['company']) ? "" : $_GET['company'];

$app = new Application($dbuser, $dbpass, $dbmain, $session, $company);

$action = $_GET['action'];
unset($_GET['action']);
$params = $_GET;

$valid_actions = array(
    'getAllProperties',
    'getProperty',
    'addProperty'
);

if(empty($action) || !in_array($action, $valid_actions))
    $app->throwError("Invalid action specified.");
else
    call_user_func(array($app, $action), $params);
?>