<?php

require_once __DIR__ . '/function/init.php';
require_once ROOT_PATH . '/config/init.php';
require_once ROOT_PATH . '/function/help.php';

set_time_limit(0);

if (mb_strpos(strtolower(PHP_SAPI), 'cli') === false) {
    exit("请使用 \033[1;31m控制台（cli）\033[0m 模式" . PHP_EOL);
}

global $configs;

$allowArgvsKeys = array_keys($configs['allow_argvs']);

if (empty($argv[1]) || !in_array($argv[1], $allowArgvsKeys)) {
    echo PHP_EOL, "请正确输入参数（举例：\033[1;31mphp -f cli.php $allowArgvsKeys[0]\033[0m）：", PHP_EOL, PHP_EOL;

    foreach ($configs['allow_argvs'] as $key => $allowArgvItem) {
        echo "\033[1;31m$key\033[0m", ' ', $allowArgvItem, PHP_EOL;
    }

    echo PHP_EOL;
    exit();
}

routing($argv[1]);

function routing($allowArgv, $retryCount = 1)
{
    try {
        $controllerClass    = 'controller\\cli\\' . $allowArgv;
        $controllerFilePath = ROOT_PATH . '/' . strtr($controllerClass, ['\\' => '/']) . '.php';
        if (!file_exists($controllerFilePath)) {
            echo "控制器文件 \033[1;31m" . $controllerFilePath . "\033[0m 不存在", PHP_EOL;
            exit();
        }

        $reflectionClass = new ReflectionClass($controllerClass);

        if (!$reflectionClass->hasMethod('run')) {
            echo "控制器 \033[1;31m$controllerFilePath run\033[0m 方法不存在", PHP_EOL;
            exit();
        }

        $constructor = $reflectionClass->getConstructor();
        $parameters  = $constructor->getParameters();

        $instance = newInstanceArgs($parameters, $reflectionClass);

        $instance->run();
    } catch (Exception $e) {
        echo $e->getMessage();

        if ($retryCount >= 3) {
            echo PHP_EOL, '已重试三次', PHP_EOL;
            exit();
        }

        $retryCount++;
        routing($allowArgv, $retryCount);
    }
}


