<?php

class input {

    function get($key = null) {
        if(is_null($key))
            return $_GET;
        else
            return (isset($_GET[$key])) ? $_GET[$key] : "";
    }

    function post($key = null) {
        if(is_null($key))
            return $_POST;
        else
            return (isset($_POST[$key])) ? $_POST[$key] : "";
    }

    function cookie($key = null) {
        if(is_null($key))
            return $_COOKIE;
        else
            return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : "";
    }

    function files($key = null) {
        if(is_null($key))
            return $_FILES;
        else
            return (isset($_FILES[$key])) ? $_FILES[$key] : "";
    }

}