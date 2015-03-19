<?php
header("Content-type:text/html; charset=utf-8;");
define('DEBUG', true);
require 'lib/Source.lib.php';

$classname = 'Action_'.$classname;
$class = new $classname;
$class->run();
?>
