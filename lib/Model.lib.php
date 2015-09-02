<?php
/**
 * @require : none
 * @author : yuwenlong@wenlong.pw
 * @date : 2015-09-02 15:53:51
 * @description : 模块基类
 */
abstract class Model{
    protected $db;

    public function init($db){
        $this->db = $db;
    }
}
