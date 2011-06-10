<?php
$path = realpath(dirname(__FILE__) . '/../');
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

function autoloader($classname) {
	require $classname . '.php';
}

spl_autoload_register('autoloader');