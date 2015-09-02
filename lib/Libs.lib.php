<?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

abstract class Libs{
    abstract protected function init();
    abstract protected function main();
	
    public function run(){
        $this->init();
        $this->before();
        $this->main();
        $this->after();
		if(!empty($this->is_smarty_fetch)){
            $this->final();
        }
    }
	
    public function before(){
        $this->config = include DIR_CONF.'config.conf.php';
        if(!empty($this->db)){
            $db_arr = include_once DIR_CONF.'db.conf.php';
            $this->load_class('mysql');
            $this->db_arr = explode(',', $this->db);
            foreach($this->db_arr as $v){
                if(!empty($v)){
                    $v = trim($v);
                    $db = $db_arr[$v];
                    $prefix = $v.'_prefix';
                    $this->$v = new Mysql($db['host'], $db['port'], $db['name'], $db['pass'], $db['database'], $db['prefix']);
                    $this->$prefix = $db['prefix'];
                }
            }
        }

        if(!empty($this->is_smarty)){
            require_once DIR_CONF.'smarty.conf.php';
            $this->smarty = $smarty;
        }
    }
	
    public function after(){
        global $file;
        if(!empty($this->tpl)){
            if(empty($this->is_smarty_fetch)){
                $this->tpl_include($this->tpl);
            }else {
                $this->tpl_con = $this->tpl_fetch($this->tpl);
            }
        }else if(!empty($this->_json_data)){
            echo json_encode($this->_json_data);
        }

        if(!empty($this->db_arr)){
            foreach((array)$this->db_arr as $v){
                $v = trim($v);
                $this->$v->close();
            }
        }
    }
	
    public function tpl_include($tpl){
        global $file;
        $t_arr = explode('_', $tpl);
        
        $tplname = '';
        foreach($t_arr as $v){
            $tplname .= htmlspecialchars(ucwords(strtolower($v)), ENT_QUOTES, 'UTF-8').'_';
        }
        $tplname = substr($tplname, 0, -1);
        $tplname = explode('/', $tplname);
        $tpl_arr_count = count($tplname);
        $tplname[$tpl_arr_count - 1] = ucwords(strtolower($tplname[$tpl_arr_count - 1]));
        $tplname = implode('/', $tplname);
        if(file_exists(DIR_TPL.$file.$tplname.'.tpl.html')){
            foreach($this as $k => $v){
                $$k = $v;
                if(!empty($this->is_smarty)){
                    $this->smarty->assign($k, $$k);
                }
            }
            if(!empty($this->is_smarty)){
                $this->smarty->display($file.$tplname.'.tpl.html');
            }else {
                require DIR_TPL.$file.$tplname.'.tpl.html';
            }
        }else {
            if(DEBUG){
                exit('模版文件: '.DIR_TPL.$file.$tplname.'.tpl.html 不存在');
            }else {
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
            }
        }
    }
	
	public function tpl_fetch($tpl){
        global $file;
        $t_arr = explode('_', $tpl);
        
        $tplname = '';
        foreach($t_arr as $v){
            $tplname .= htmlspecialchars(ucwords(strtolower($v)), ENT_QUOTES, 'UTF-8').'_';
        }
        $tplname = substr($tplname, 0, -1);
        $tplname = explode('/', $tplname);
        $tpl_arr_count = count($tplname);
        $tplname[$tpl_arr_count - 1] = ucwords(strtolower($tplname[$tpl_arr_count - 1]));
        $tplname = implode('/', $tplname);
        if(file_exists(DIR_TPL.$file.$tplname.'.tpl.html')){
            foreach($this as $k => $v){
                $$k = $v;
                if(!empty($this->is_smarty)){
                    $this->smarty->assign($k, $$k);
                }
            }
            if(!empty($this->is_smarty)){
                return $this->smarty->fetch($file.$tplname.'.tpl.html');
            }else {
                require DIR_TPL.$file.$tplname.'.tpl.html';
            }
        }else {
            if(DEBUG){
                exit('模版文件: '.DIR_TPL.$file.$tplname.'.tpl.html 不存在');
            }else {
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                include_once '/404.htm';
                exit();
            }
        }
    }

    public function load_fun($fun_name){
        if(file_exists(DIR_FUN.ucwords(strtolower($fun_name)).'.fun.php')){
            require_once DIR_FUN.ucwords(strtolower($fun_name)).'.fun.php';
        }else {
            if(DEBUG){
                exit('函数文件：'.ucwords(strtolower($fun_name)).'.fun.php 不存在');
            }else {
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
            }
        }
    }

    public function load_class($class_name){
        if(file_exists(DIR_CLASS.ucwords(strtolower($class_name)).'.class.php')){
            require_once DIR_CLASS.ucwords(strtolower($class_name)).'.class.php';
        }else {
            if(DEBUG){
                exit('类文件：'.ucwords(strtolower($class_name)).'.class.php 不存在');
            }else {
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
            }
        }
    }
}
