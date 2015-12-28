<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

class Action_Smarty extends Libs{
    function __construct(){
        $this->is_smarty = true;
		$this->tpl = 'index/smarty';
		$this->title = '22';
	}
	function index(){
	}
}
