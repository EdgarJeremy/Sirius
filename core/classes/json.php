<?php

class json {

    public function __construct() {
    }

    static public function output($data) {
        echo json_encode($data);
    }

}