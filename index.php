<?php
header("Content-type:text/html; charset=utf-8;");
/**
 * development
 * testing
 * production
 * */
define('ENVIRONMENT', isset($_SERVER['LONG_ENV']) ? $_SERVER['LONG_ENV'] : 'production');
require 'lib/Source.lib.php';

$classname = 'Action_'.$classname;
$class = new $classname;
$class->run();
?>
