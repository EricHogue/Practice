<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);

function autoload($className) {
	$file = $className . '.php';
	if (file_exists($file)) {
		require $className . '.php';
	}
}

spl_autoload_register('autoload');
