<?php


class loader {

    private $context;

    public function __construct($context) {
        $this->context = $context;
    }

    public function library($libName) {
        $autoload_libs = getConfig("autoload","library");
        if(in_array($libName,$autoload_libs)) {
            return;
        } elseif($libName === "database") {
            $this->context->db = getDb();
            return;
        }
        if(file_exists("core/libraries/{$libName}.php")) {
            require_once "core/libraries/{$libName}.php";
            $this->context->$libName = new $libName();
        }
    }

    public function model() {
        $autoload_model = getConfig("autoload","model");
        
    }

}