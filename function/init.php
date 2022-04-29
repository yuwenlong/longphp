<?php

define('ROOT_PATH', dirname(__DIR__));

const LONGPHP_VERSION = '1.1.0';

if (PHP_MAJOR_VERSION < 8) {
    if (mb_strpos(strtolower(PHP_SAPI), 'cli') === false || PHP_SAPI == 'cli-server') {
        exit('请使用 <span style="color: red;">PHP8</span> 及以上版本');
    }

    exit("请使用 \033[1;31mPHP8\033[0m 及以上版本" . PHP_EOL);
}

if (!function_exists('env')) {
    $envCon = '';

    function env($key = '', $default = '')
    {
        global $envCon;

        if (empty($envCon)) {
            $envCon = parse_ini_file(ROOT_PATH . '/.env', true);
        }

        if (empty($key)) {
            return $envCon;
        }

        $keyArr = explode('.', $key);

        return $envCon[$keyArr[0]][$keyArr[1]] ?? $default;
    }
}
