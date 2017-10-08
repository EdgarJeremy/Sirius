<?php
/**
 * Inisial konfig
 */
$config = array();

/**
 * App
 */
$config["app"]["name"] = "Sirius Framework";
$config["app"]["version"] = "0.0.2";

/**
 * Konfigurasi URL
 * Untuk aplikasi dalam sub direktori,
 * base_dir harus diisi manual
 */
$config["url"]["base_host"] = "http://" . $_SERVER["HTTP_HOST"];
$config["url"]["base_dir"] = "/sirius_dev/sirius-0.0.2/"; // Default / Root directory
$config["url"]["base_url"] = $config["url"]["base_host"] . $config["url"]["base_dir"];

/**
 * Database
 * https://www.codeigniter.com/user_guide/database/index.html
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
 * Autoload
 */
$config["autoload"]["library"] = array();
$config["autoload"]["model"] = array();

/**
 * Session
 */
$config["session"]["key"] = $config["app"]["name"] . "-" . $config["app"]["version"];
$config["session"]["cookie_name"] = "sirius_session";

/**
 * Model
 */
$config["model"]["model_prepend"] = "_model";

/**
 * Field respon default
 */
$config["response_field"]["f_get"] = false;
$config["response_field"]["f_post"] = false;
$config["response_field"]["f_cookie"] = false;
$config["response_field"]["f_method"] = true;
$config["response_field"]["f_headers"] = false;
$config["response_field"]["f_remote_ip"] = true;
$config["response_field"]["f_waktu_eksekusi"] = true;

/**
 * Default route
 */
$config["route"]["default_basepoint"] = "api";
$config["route"]["default_endpoint"] = "index";

/**
 * Auth
 * Mekanisme auth membutuhkan koneksi database
 * pastikan sebelum mengaktifkan auth, konfigurasi database terlebih dahulu
 * dan aktifkan database dalam autoloader
 * 'table_name' adalah nama tabel database untuk mengisi auth key
 * 'header_key' adalah nama key header yang harus dikirim saat melakukan request dengan auth key
 * nilai header_key adalah nilai valid dari sebuah key untuk header HTTP
 * jika punya dua kata, harus dihubungkan dengan tanda dash '-'
 */
$config["auth"]["use_key"] = false;
$config["auth"]["auto_permit_local"] = true;
$config["auth"]["table_name"] = "sirius_auth";
$config["auth"]["header_key"] = "Sirius-Key";

/**
 * Assign ke $GLOBALS untuk pemakaian global
 */
$GLOBALS["config"] = $config;