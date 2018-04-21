<?php
/**
 * @require : none
 * @author : yu@wenlong.org
 * @date : 2015-09-02 15:53:51
 * @description : 模块基类
 */
 if(!defined('DIR')){
	exit('Please correct access URL.');
}
 
abstract class Model{
    protected $db;
    protected $where_str;
    protected $table_name;
    protected $select_fields;
    protected $limit;
    protected $order_by;
    protected $group_by;
    protected $getLastSql;

    public function init($db){
        $this->db = $db;
    }

    protected function where($key, $value = ''){
        if(!empty($this->where_str)){
            $this->where_str .= ' AND ';
        }

        if(is_array($key) && empty($value)){
            foreach($key as $kk => $vv){
                $kk_arr = explode(' ', $kk);
                if(count($kk_arr) == 1){
                    $this->where_str .= '`'.trim($key).'` = \''.trim($vv).'\' AND ';
                }else {
                    $this->where_str .= '`'.trim($kk_arr[0]).'` '.trim($kk_arr[1]).' '.trim($vv).' AND ';
                }
            }
        }

        if(!is_array($key) && !empty($value)){ 
            $kk_arr = explode(' ', $key);
            if(count($kk_arr) == 1){
                $this->where_str .= '`'.trim($key).'` = \''.trim($value).'\' AND ';
            }else {
                $this->where_str .= '`'.$kk_arr[0].'` '.$kk_arr[1].' '.$value.' AND ';
            }
        }

        $this->where_str = mb_substr($this->where_str, 0, -4);
        return $this;
    }

    protected function select($fields = ''){
        if(!empty($fields)){
            $fields_arr = explode(',', $fields);
            foreach($fields_arr as $fv){
                $this->select_fields .= '`'.trim($fv).'`, ';
            }
        }

        $this->select_fields = mb_substr($this->select_fields, 0, -2);
        return $this;
    }

    protected function limit($m, $n){
        if(empty($m)){
            return false;
        }

        $limit = trim($m).', ';

        if(!empty($n)){
            $limit .= trim($n).', ';
        }

        $this->limit = mb_substr($limit, 0, -2);
        return $this;
    }

    protected function order_by($key, $sort = 'ASC'){
        if(!empty($this->order_by)){
            $this->order_by .= ', ';
        }
        $this->order_by .= '`'.trim($key).'` '.strtoupper(trim($sort)).', ';
        $this->order_by = mb_substr($this->order_by, 0, -2);
        return $this;
    }

    protected function group_by($key){
        if(!empty($this->group_by)){
            $this->group_by .= ', ';
        }
        $this->group_by .= '`'.trim($key).'`, ';
        $this->group_by = mb_substr($this->group_by, 0, -2);
        return $this;
    }

    /**
     * $return_way 返回方式 result_array | row_array
     */
    protected function get($table_name, $return_way = 'result_array'){
        if(empty($table_name)){
            return false;
        }

        if(empty($this->select_fields)){
            $this->select_fields = '*';
        }

        if(!empty($this->where_str)){
            $this->where_str = ' WHERE '.$this->where_str;
        }
        
        if(!empty($this->order_by)){
            $this->order_by = ' ORDER BY '.$this->order_by;
        }
        
        if(!empty($this->group_by)){
            $this->group_by = ' GROUP BY '.$this->group_by;
        }

        if(!empty($this->limit)){
            $this->limit = ' '.$this->limit;
        }

        $sql = 'SELECT '.$this->select_fields.' FROM `'.$table_name.'`'.$this->where_str.$this->group_by.$this->order_by.$this->limit;
        $this->getLastSql = $sql;

        if($return_way == 'result_array'){
            $res = $this->db->fetchAll($sql);
        }else if($return_way == 'row_array'){
            $res = $this->db->fetchFirst($sql);
        }

        return $res;
    }
}
