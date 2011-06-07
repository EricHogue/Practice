<?php
$path = realpath(dirname(__FILE__) . '/../');
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function __autoload($class_name) {
    require $class_name . '.php';
}

spl_autoload_register('__autoload');