<?php

namespace controller\cli;

use controller\baseController;
use model\attackDsModel;
use service\datasourceService;

class getDataSources extends baseController
{
    private attackDsModel     $attackDsModel;
    private datasourceService $datasourceService;

    public function __construct(attackDsModel $attackDsModel, datasourceService $datasourceService)
    {
        $this->attackDsModel     = $attackDsModel;
        $this->datasourceService = $datasourceService;

        parent::__construct();
    }

    public function run()
    {
        $datasourse = $this->datasourceService->getDatasource();

        $datasourceData     = $this->attackDsModel->getData();
        $datasourceDataDSid = array_column($datasourceData, 'ds_id');

        $newDatasourceData = [];
        foreach ($datasourse as $item) {
            $newDatasourceData[] = $item;
        }
        $newDatasourceData     = array_combine(array_column($newDatasourceData, 'ds_id'), $newDatasourceData);
        $newDatasourceDataDSid = array_keys($newDatasourceData);

        echo "\033[1;31mdatasource 数据抓取完毕，总共抓取 ", count($newDatasourceDataDSid), " 条\033[0m", PHP_EOL;

        // 需要删除的数据
        $deleteDSid = array_diff($datasourceDataDSid, $newDatasourceDataDSid);

        // 需要增量添加的数据
        $addDSid = array_diff($newDatasourceDataDSid, $datasourceDataDSid);

        $this->attackDsModel->deleteData($deleteDSid);

        $addData = array_filter($newDatasourceData, function ($item) use ($addDSid) {
            return in_array($item['ds_id'], $addDSid);
        });

        $this->attackDsModel->addData($addData);

        echo "\033[1;31m删除数据 ", count($deleteDSid), ' 条，添加数据 ' . count($addDSid), " 条\033[0m", PHP_EOL, PHP_EOL;
    }
}