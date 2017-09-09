<?php

class router {

    const DEFAULT_BASEPOINT = "api";
    const DEFAULT_ENDPOINT = "index";

    protected $basePoint = self::DEFAULT_BASEPOINT;
    protected $endPoint = self::DEFAULT_ENDPOINT;
    protected $params = array();
    protected $basePath;

    public function __construct(array $options = array()) {
        $this->basePath = getConfig("base_dir");
        if(empty($options)) {
            $this->parseUri();
        } else {
            if(isset($options["basepoint"])) {
                $this->setBasepoint($options["basepoint"]);
            } 
            if(isset($options["endpoint"])) {
                $this->setEndpoint($options["endpoint"]);
            }
            if(isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    public function parseUri() {
        $path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
        $path = trim(str_replace($this->basePath,"",$path),"/");
        $parts = explode("/",$path,3);
        if(isset($parts[0])) {
            if($parts[0] != "")
                $this->setBasepoint($parts[0]);
        }
        if(isset($parts[1])) {
            $this->setEndpoint($parts[1]);
        }
        if(isset($parts[2])) {
            $this->setParams(explode("/",$parts[2]));
        }
    }

    public function setBasepoint($basePoint) {
        $basePoint = strtolower($basePoint);
        $this->basePoint = $basePoint;
        return $this;
    }

    public function setEndpoint($endPoint) {
        $endPoint = strtolower($endPoint);
        $this->endPoint = $endPoint;
        return $this;
    }

    public function setParams($params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        if(!file_exists("app/basepoints/{$this->basePoint}.php")) {
            json::output(array(
                "status" => false,
                "pesan" => "Basepoint '{$this->basePoint}' tidak ditemukan"
            ));
            exit();
        } else {
            $basePointClass = new $this->basePoint;
        }
        if(!method_exists($basePointClass,$this->endPoint)) {
            json::output(array(
                "status" => false,
                "pesan" => "Endpoint '{$this->endPoint}' tidak ditemukan di basepoint '{$this->basePoint}'"
            ));
            exit();
        }
        call_user_func_array(array($basePointClass,$this->endPoint),$this->params);
    }

    private function getRealBasepoint() {
        return str_replace("_basepoint","",$this->basePoint);
    }

}