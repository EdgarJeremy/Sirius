<?php
/**
 * tcFramework
 * v0.0.1
 * Copyright 2017
 * developed by TagConn development team
 */

$errors = array();
error_reporting(0);
require_once "core/helpers.php";
require_once "core/autoload.php";
require_once "app/config/config.php";
set_error_handler("noticeError");
register_shutdown_function("fatalError");



$router = new router();
$router->run();


if(!empty($errors)) {
    json::output($errors);
}