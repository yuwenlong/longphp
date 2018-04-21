<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

class Action_Smarty extends Libs{
    function __construct(){
        $this->is_smarty = true;
        $this->db = 'db1';
	}
    function index(){
        $this->title = '22';
        $_SESSION['name'] = 'hehe';

        $model = M('user/user', $this->db1);
        $res = $model->get_list();
        print_r($res);

		$this->tpl = 'index/smarty';
	}
}
