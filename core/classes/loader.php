<?php


class loader {

    private $context;

    public function __construct($context) {
        $this->context = $context;
    }

    public function library($libName) {
        if(isset($this->context->$libName)) {
            return;
        } elseif($libName === "database" && !isset($this->context->db)) {
            $this->context->db = getDb();
            return;
        }
        if(file_exists("core/libraries/{$libName}.php")) {
            require_once "core/libraries/{$libName}.php";
            $this->context->$libName = new $libName();
        }
    }

    public function model($modelName) {
        if(isset($this->context->$modelName)) {
            return;
        }
        $className = $modelName.getConfig("model","model_prepend");
        if(file_exists("app/models/{$className}.php")) {
            require_once "app/models/{$className}.php";
            $this->context->$modelName = new $className($this->context->db);
        }
    }

}