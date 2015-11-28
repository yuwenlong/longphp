<?php
/**
 * @require : none
 * @author : yuwenlong@wenlong.org
 * @date : 2015-09-02 15:45:05
 * @description : this is a new file 
 */
 if(!defined('DIR')){
	exit('Please correct access URL.');
}
 
class Reg extends Model {
    function get(){
        print_r($this->db);
    }
}
