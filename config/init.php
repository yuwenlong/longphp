<?php

require_once 'constant.php';

// CLI 允许的参数白名单
$configs['allow_argvs'] = [
    'getSoftware' => 'xxxxxx',
];

// web 默认控制器
$configs['web'] = [
    'default_controller' => env('default.web_default_controller')
];

$configs['log'] = [
    'path' => ROOT_PATH . '/' . env('log.path_dir') . '/' . date('Y-m-d') . '.log'
];

$configs['db'] = [
    'default' => env('default.db_default'),
    'mysql'   => [
        'host'     => env('mysql.host'),
        'port'     => env('mysql.port'),
        'database' => env('mysql.database'),
        'user'     => env('mysql.user'),
        'pass'     => env('mysql.pass')
    ]
];