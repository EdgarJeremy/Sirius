<?php

function loader($classname) {
    if(file_exists("app/basepoints/{$classname}.php")) {
        require_once "app/basepoints/{$classname}.php";
    } elseif(file_exists("app/model/{$classname}.php")) {
        require_once "app/model/{$classname}.php";
    } elseif(file_exists("core/classes/{$classname}.php")) {
        require_once "core/classes/{$classname}.php";
    }
}

spl_autoload_register("loader");