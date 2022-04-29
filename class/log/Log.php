<?php

namespace class\log;

class Log
{
    private static mixed $selfObject;
    private string       $logFile;

    const LEVEL_INFO  = 1;
    const LEVEL_ERROR = 2;
    const LEVEL_WARN  = 3;

    const LEVEL = [
        self::LEVEL_INFO  => 'info',
        self::LEVEL_ERROR => 'error',
        self::LEVEL_WARN  => 'warn'
    ];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private static function init()
    {
        global $configs;

        if (empty(self::$selfObject)) {
            $logPath = pathinfo($configs['log']['path']);
            if (!is_dir($logPath['dirname'])) {
                mkdir($logPath['dirname'], 0777, true);
            }

            self::$selfObject          = new self();
            self::$selfObject->logFile = $configs['log']['path'];
        }

        return self::$selfObject;
    }

    public static function __callStatic($funName, $arguments)
    {
        if (!in_array($funName, self::LEVEL)) {
            return;
        }
        array_unshift($arguments, $funName);

        call_user_func_array([self::init(), 'writeLog'], $arguments);
    }

    private function writeLog(string $logType, string $message, array $params = []): void
    {
        $logCon = '[' . date('Y-m-d H:i:s') . '] ' . strtoupper($logType) . ' "' . addslashes($message) . '" ' .
                  json_encode($params) . PHP_EOL;
        file_put_contents($this->logFile, $logCon, FILE_APPEND);
    }
}