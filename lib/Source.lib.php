<?php
if(DEBUG){
    ini_set('display_errors', 1);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

define('LONGPHP_VERSION', 1.0.0);
define('DIR', strtr(dirname(dirname(__FILE__)), array('\\'=>'/')).'/');
define('DIR_APP', DIR.'app/');
define('DIR_CLASS', DIR.'class/');
define('DIR_CONF', DIR.'conf/');
define('DIR_FUN', DIR.'fun/');
define('DIR_LIB', DIR.'lib/');
define('DIR_TPL', DIR.'tpl/');
define('DIR_MODEL', DIR.'model/');
require_once DIR_LIB.'Libs.lib.php';
require_once DIR_CLASS.'Request.class.php';
require_once DIR_FUN.'Source.fun.php';

$key = 'jfaawiaw;sadhawkjaw123SAWDasd';

$c = empty(Request::get('c')) ? 'index' : Request::get('c');
$c_arr = explode('_', strtr($c, array('../' => '', './' => '', '/' => '', '\\' => '')));

$f = empty(Request::get('f')) ? 'index/' : Request::get('f');
$f = explode('.', strtr($f, array('../' => '', './' => '', '/' => '', '\\' => '')));
$file = '';
foreach((array)$f as $v){
	if(!empty($v)){
		$file .= $v.'/';
	}
}

$classname = '';
foreach($c_arr as $v){
	$classname .= htmlspecialchars(ucwords(strtolower($v)), ENT_QUOTES, 'UTF-8').'_';
}
$classname = substr($classname, 0, -1);


if(!file_exists(DIR_APP.$file.$classname.'.app.php')){
	if(DEBUG){
		exit('文件：'.DIR_APP.$file.$classname.'.app.php 不存在');
    }else {
		header('HTTP/1.1 404 Not Found'); 
        header("status: 404 Not Found");
	}
}else {
    autoload($classname);
}

