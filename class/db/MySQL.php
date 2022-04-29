<?php

namespace class\db;

class MySQL
{
    protected static string $configConn;
    private static mixed    $selfObject;
    private static array    $configs;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public static function init(): object
    {
        global $configs;
        self::$configs = $configs;

        if (empty(static::$configConn)) {
            static::$configConn = $configs['db']['default'];
        }

        $classArr  = explode('\\', static::class);
        $className = array_pop($classArr);

        if (empty(self::$selfObject[$className])) {
            self::$selfObject[$className] = new static();
            self::$selfObject[$className]->dbConnect();
        }

        $tableName = toUnderScore(lcfirst(strtr($className, ['Model' => ''])));

        self::$selfObject[$className]->tableName = self::$selfObject[$className]->tableName ?? $tableName;

        return self::$selfObject[$className];
    }

    public static function query()
    {
        $object = static::init();

        return $object;
    }

    public static function queryRaw($sql): object
    {
        $object = static::init();

        $object->result = mysqli_query($object->conn, $sql);

        return $object;
    }

    public function fetchAll(): array
    {
        $object = static::init();

        return mysqli_fetch_all($object->result, MYSQLI_ASSOC);
    }

    protected function dbConnect()
    {
        if (!empty($this->conn)) {
            return $this->conn;
        }

        $this->conn = mysqli_connect(
            self::$configs['db'][static::$configConn]['host'] . ':' . self::$configs['db'][static::$configConn]['port'],
            self::$configs['db'][static::$configConn]['user'],
            self::$configs['db'][static::$configConn]['pass'],
            self::$configs['db'][static::$configConn]['database']
        );
    }

    protected function getTableName()
    {
        $object = static::init();

        return $object->tableName;
    }
}