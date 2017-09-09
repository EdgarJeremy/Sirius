<?php

/**
 * Ambil variable konfigurasi yang terdefinisi di 'app/config/config.php'
 * @param [string] $name
 * @return mixed[string|null]
 */
function getConfig($name) {
    return (isset($GLOBALS["config"][$name])) ? $GLOBALS["config"][$name] : null;
}

/**
 * exit() tanpa error
 * @return void
 */
function stop() {
    define("TERHENTI",true);
    exit();
}

/**
 * Kostum fatal error handler
 * setup di register_shutdown_function()
 * @return void
 */
function fatalError() {
    if(error_get_last() !== NULL && !defined("TERHENTI")) {
        header("Content-Type: application/json;charset=utf-8");
        $error = error_get_last();
        $error["code"] = $error["type"];
        $error["type"] = tipeError($error["type"]);
        echo json_encode([$error]);
    }
}

/**
 * Kostum non-fatal error handler
 * setup di set_error_handler()
 * @param [integer] $errno
 * @param [string] $errstr
 * @param [string] $errfile
 * @param [integer] $errline
 * @return void
 */
function noticeError($errno, $errstr, $errfile, $errline) {
    global $errors;
    $errors[] = array(
        "file" => $errfile,
        "line" => $errline,
        "message" => $errstr,
        "code" => $errno,
        "type" => tipeError($errno)
    );
}

function ambilWebdirDinamis() {
    $url = $_SERVER['REQUEST_URI'];
    $url = explode("/",$url,3);
    return "/" . $url[1];
}

/**
 * Ambil instance dari CI_DB
 *
 * @return ci_db\CI_DB instance
 */
function getDb() {
    require_once "library/ci_db/DB.php";
    $db =&ci_db\DB(getConfig("database"));
    return $db;
}

/**
 * Ambil string tipe error berdasarkan kode error
 *
 * @param [integer] $type
 * @return string
 */
function tipeError($type) 
{ 
    switch($type) 
    { 
        case E_ERROR: // 1 // 
            return 'E_ERROR'; 
        case E_WARNING: // 2 // 
            return 'E_WARNING'; 
        case E_PARSE: // 4 // 
            return 'E_PARSE'; 
        case E_NOTICE: // 8 // 
            return 'E_NOTICE'; 
        case E_CORE_ERROR: // 16 // 
            return 'E_CORE_ERROR'; 
        case E_CORE_WARNING: // 32 // 
            return 'E_CORE_WARNING'; 
        case E_COMPILE_ERROR: // 64 // 
            return 'E_COMPILE_ERROR'; 
        case E_COMPILE_WARNING: // 128 // 
            return 'E_COMPILE_WARNING'; 
        case E_USER_ERROR: // 256 // 
            return 'E_USER_ERROR'; 
        case E_USER_WARNING: // 512 // 
            return 'E_USER_WARNING'; 
        case E_USER_NOTICE: // 1024 // 
            return 'E_USER_NOTICE'; 
        case E_STRICT: // 2048 // 
            return 'E_STRICT'; 
        case E_RECOVERABLE_ERROR: // 4096 // 
            return 'E_RECOVERABLE_ERROR'; 
        case E_DEPRECATED: // 8192 // 
            return 'E_DEPRECATED'; 
        case E_USER_DEPRECATED: // 16384 // 
            return 'E_USER_DEPRECATED'; 
    } 
    return ""; 
} 