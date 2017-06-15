<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

return array(
    'db1' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'name' => 'root',
        'pass' => '1111',
        'database' => 'test',
        'prefix' => '',
		'charset' => 'utf8mb4'
    ),
    'db2' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'name' => 'root',
        'pass' => '1111',
        'database' => 'mysql',
        'prefix' => '',
		'charset' => 'utf8mb4'
    ),
);
