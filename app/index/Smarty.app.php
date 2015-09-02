<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

class Action_Smarty extends Libs{
    function init(){
        $this->is_smarty = true;
		$this->tpl = 'smarty';
		$this->title = '22';
	}
	function main(){
	}
}
