<?php

class session {

    private $session_key;
    private $curr_session;

    public function __construct() {
        session_start();
        $this->session_key = getConfig("session","key");
        if(!isset($_SESSION[$this->session_key]))
            $_SESSION[$this->session_key] = array();
    }

    public function userdata($name = null) {
        if(is_null($name)) {
            return $_SESSION[$this->session_key];
        } else {
            return $_SESSION[$this->session_key][$name];
        }
    }

    public function set_userdata($key,$value = null) {
        if(is_array($key)) {
            $_SESSION[$this->session_key] = $key;
        } else {
            $_SESSION[$this->session_key][$key] = $value;
        }
    }

    public function has_userdata($key) {
        return (isset($_SESSION[$this->session_key][$key]));
    }

    public function sess_destroy() {
        unset($_SESSION[$this->session_key]);
    }

}