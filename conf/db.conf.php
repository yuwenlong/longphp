<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

return array(
    'db1' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'name' => 'root',
        'pass' => 'root',
        'database' => 'test',
        'prefix' => '',
    ),
    'db2' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'name' => 'root',
        'pass' => 'root',
        'database' => 'mysql',
        'prefix' => '',
    ),
);
