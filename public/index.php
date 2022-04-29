<?php

require_once __DIR__ . '/../function/init.php';
require_once ROOT_PATH . '/config/init.php';
require_once ROOT_PATH . '/function/help.php';

global $configs;

if (mb_strpos(strtolower(PHP_SAPI), 'cli') !== false && PHP_SAPI != 'cli-server') {
    header('Content-type: text/html; charset=utf-8');
    exit("不能使用 \033[1;31m控制台（cli）\033[0m 模式" . PHP_EOL);
}

$pathInfo = explode('/', $configs['web']['default_controller']);

if (!empty($_SERVER['PATH_INFO'])) {
    $pathInfo = explode('/', $_SERVER['PATH_INFO']);
    array_shift($pathInfo);
}

$controller      = toCamelCase(array_pop($pathInfo));
$controllerClass = 'controller\\web\\' . $controller;
if (!empty($pathInfo)) {
    $controllerClass = 'controller\\web\\' . implode('\\', $pathInfo) . '\\' . $controller;
}
$controllerFilePath = ROOT_PATH . '/' . strtr($controllerClass, ['\\' => '/']) . '.php';

if (!file_exists($controllerFilePath)) {
    echo '控制器文件 <span style="color: red;">' . $controllerFilePath . '</span> 不存在', PHP_EOL;
    exit();
}

try {
    $reflectionClass = new ReflectionClass($controllerClass);

    if (!$reflectionClass->hasMethod('run')) {
        echo '控制器 <span style="color: red;">' . $controllerFilePath . ' 的 function run</span> 不存在', PHP_EOL;
        exit();
    }

    $constructor = $reflectionClass->getConstructor();
    $parameters  = $constructor->getParameters();

    $instance = newInstanceArgs($parameters, $reflectionClass);

    $instance->run();
} catch (Exception $e) {
    echo $e->getMessage();
}

