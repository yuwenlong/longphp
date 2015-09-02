<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

class Action_Index extends Libs{
	function init(){
		$this->tpl = 'index';
		$this->title = '22';
        $this->db = 'db1, db2';
	}
    function main(){
        // 框架内置 POST GET
        $a = Request::post('aa');
        $b = Request::post_int('bb');
        $c = Request::post_email('cc');
        $d = Request::post_phone('dd');

        $e = Request::get('aa');
        $f = Request::get_int('bb');
        $g = Request::get_email('cc');
        $h = Request::get_phone('dd');

        $reg = M('user/reg', $this->db1);   //  加载模型
        $reg->get();

        $reg1 = M('user/reg', $this->db2);
        $reg1->get();
	}
}
