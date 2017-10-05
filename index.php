<?php
/**
 * Sirius
 * v0.0.1
 * Copyright 2017
 * developed by TagConn development team
 */

 /**
  * Penampung error
  */
$errors = array();
/** Set reporting ke mode disable */
error_reporting(0);
ob_start();

/** Require file */
require_once "core/helpers.php";
require_once "core/autoload.php";
require_once "app/config/config.php";

/** Set kostum error handle */
set_error_handler("noticeError");
register_shutdown_function("fatalError");

/** Instansiasi objek router */
$router = new router();
$router->run();

/** Output error */
cekError();
// if(!empty($errors)) {
//     json::output($errors);
// }