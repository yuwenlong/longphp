<?php
if(!defined('DIR')){
    exit('请正确访问URL');
}

class Action_Yanzhengma extends Libs{
    function init(){
    }

    function main(){
        $this->load_class('verification_code');
    }
}
