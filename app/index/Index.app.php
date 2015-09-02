<?php
class Action_Index extends Libs{
	function init(){
		$this->tpl = 'index';
		$this->title = '22';
        $this->db = 'db1, db2';
	}
	function main(){
        $reg = M('user/reg', $this->db1);
        $reg->get();

        $reg1 = M('user/reg', $this->db2);
        $reg1->get();
	}
}
