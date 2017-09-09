<?php
/**
 * Inisial konfig
 */
$config = array();

/*
** Konfigurasi url 
*/
$config["url"]["base_host"] = "http://" . $_SERVER["HTTP_HOST"];
$config["url"]["base_dir"] = ambilWebdirDinamis();
$config["url"]["base_url"] = $config["url"]["base_host"] . $config["url"]["base_dir"];

/**
 * database
 */
$config["database"]["dsn"] = "";
$config["database"]["hostname"] = "localhost";
$config["database"]["username"] = "root";
$config["database"]["password"] = "";
$config["database"]["database"] = "";
$config["database"]["dbdriver"] = "mysqli";
$config["database"]["dbprefix"] = "";
$config["database"]["pconnect"] = false;
$config["database"]["db_debug"] = true;
$config["database"]["cache_on"] = false;
$config["database"]["cachedir"] = "";
$config["database"]["char_set"] = "utf8";
$config["database"]["dbcollat"] = "utf8_general_ci";
$config["database"]["swap_pre"] = "";
$config["database"]["encrypt"] = false;
$config["database"]["compress"] = false;
$config["database"]["stricton"] = false;
$config["database"]["failover"] = array();
$config["database"]["save_queries"] = true;

/**
 * Development environment
 */
$config["env"]["izinkan_browser"] = true;

/**
 * Autoload library
 */
$config["autoload"]["library"] = array();
$config["autoload"]["model"] = array();

/**
 * Model
 */
$config["model"]["model_prepend"] = "_model";

/**
 * Default route
 */
$config["route"]["default_basepoint"] = "api";
$config["route"]["default_endpoint"] = "index";

/**
 * Assign ke $GLOBALS untuk pemakaian global
 */
$GLOBALS["config"] = $config;