<?php
/**
 * development
 * testing
 * production
 * */
define('ENVIRONMENT', isset($_SERVER['LONG_ENV']) ? $_SERVER['LONG_ENV'] : 'development');
require 'lib/Source.lib.php';

$classname = 'Action_'.$classname;
$class = new $classname;
$class->run();
?>
