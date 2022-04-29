<?php

namespace model;

class attackDsModel extends baseModel
{
    const DELETE_DATA_FOR_TABLES = [
        'attack_r_ds_t'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取表数据
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return self::queryRaw('select * from `' . self::getTableName() . '`')->fetchAll();
    }

    /**
     * 删除数据
     *
     * @param array $sids
     * @return bool
     */
    public function deleteData(array $gids): bool
    {
        if (empty($gids)) {
            return false;
        }

        $where = '';
        foreach ($gids as $gid) {
            $where .= '`ds_id`=\'' . $gid . '\' OR ';
        }

        self::queryRaw('DELETE FROM `' . self::getTableName() . '` WHERE ' . mb_substr($where, 0, -4));

        foreach (self::DELETE_DATA_FOR_TABLES as $table) {
            self::queryRaw('DELETE FROM `' . $table . '` WHERE ' . mb_substr($where, 0, -4));
        }

        return true;
    }

    /**
     * 添加数据
     *
     * @param array $data
     * @return bool
     */
    public function addData(array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        $insertData = '';
        foreach ($data as $datum) {
            $insertData .= '(\'' . addslashes($datum['ds_id']) . '\',\'' . addslashes($datum['ds_name']) . '\',\'' .
                           addslashes($datum['ds_desc']) . '\'),';
        }

        self::queryRaw(
            'INSERT INTO `' . self::getTableName() . '` (`ds_id`,`ds_name`,`ds_desc`) VALUES '
            . mb_substr($insertData, 0, -1)
        );

        return true;
    }
}