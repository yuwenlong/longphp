<?php
/**
 * @require : none
 * @author : yuwenlong@wenlong.org
 * @date : 2015-09-02 15:53:51
 * @description : 模块基类
 */
 if(!defined('DIR')){
	exit('Please correct access URL.');
}
 
abstract class Model{
    protected $db;

    public function init($db){
        $this->db = $db;
    }
}
