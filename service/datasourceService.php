<?php

namespace service;

use Exception;
use Generator;

class datasourceService extends baseService
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 抓取 https://attack.mitre.org/datasources/ 内容
     * 获取 ID Name Description
     *
     * @return Generator
     * @throws Exception
     */
    public function getDatasource(): Generator
    {
        $con = curlCon(DATASOURCE_SITE);

        preg_match(
            '/<table(.*?)table-alternate(.*?)>([\s\S]*?)<tbody\>([\s\S]*?)<\/tbody>/',
            $con,
            $patternCon
        );

        if (empty($patternCon)) {
            throw new Exception('table-alternate 不存在' . PHP_EOL, 200);
        }

        preg_match_all('/<tr[^>]*>[\s\S]*?<\/tr>/', $patternCon[4], $bodyTr);

        if (empty($bodyTr)) {
            throw new Exception('table-alternate tbody tr 不存在' . PHP_EOL, 200);
        }

        foreach ($bodyTr[0] as $trs) {
            preg_match_all('/<td>([\s\S]*?)<\/td>/', $trs, $tds);
            if (empty($tds)) {
                continue;
            }

            yield [
                'ds_id'   => trim(strip_tags($tds[0][0])),
                'ds_name' => trim(strip_tags($tds[0][1])),
                'ds_desc' => trim(strip_tags($tds[0][2]))
            ];
        }
    }
}