<?php

class input {

    public function get($key = null) {
        if(is_null($key))
            return $_GET;
        else
            return (isset($_GET[$key])) ? $_GET[$key] : "";
    }

    public function post($key = null) {
        $phpInput = (array)json_decode(file_get_contents("php://input"));
        if(is_null($key))
            return (empty($_POST)) ? $phpInput : $_POST;
        else
            return (isset($_POST[$key])) ? $_POST[$key] : ((isset($phpInput[$key])) ? $phpInput[$key] : "");
    }

    public function cookie($key = null) {
        if(is_null($key))
            return $_COOKIE;
        else
            return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : "";
    }

    public function files($key = null) {
        if(is_null($key))
            return $_FILES;
        else
            return (isset($_FILES[$key])) ? $_FILES[$key] : "";
    }

    public function has_get($key) {
        return (isset($_GET[$key]));
    }

    public function has_post($key) {
        return (isset($_POST[$key]));
    }

    public function has_cookie($key) {
        return (isset($_COOKIE[$key]));
    }

    public function has_files($key) {
        return (isset($_FILES[$key]));
    }

    public function ajax_request() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

}