<?php
/**
 * Inisial konfig
 */
$config = array();

/*
** Konfigurasi url 
*/
$config["base_host"] = "http://" . $_SERVER["HTTP_HOST"];
$config["base_dir"] = ambilWebdirDinamis();
$config["base_url"] = $config["base_host"] . $config["base_dir"];

/**
 * Konfigurasi database
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
 * Model
 */
$config["model_prepend"] = "_model";

/**
 * Assign ke $GLOBALS untuk pemakaian global
 */
$GLOBALS["config"] = $config;