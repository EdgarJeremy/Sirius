<?php

class json {

    public function __construct() {
    }

    static public function output($data) {
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
        exit();
    }

}