<?php
/**
 * @require : none
 * @author : yuwenlong@wenlong.org
 * @date : 2015-11-14 14:11:10
 * @description : 路由类 
 */
class Router{
    public $class = 'index';
    public $method = 'index';
    public $dir = 'index/';

    function run(){
        $this->load();
    }

    private function load(){
        $uri_arr = explode('?', $_SERVER['REQUEST_URI']);

        if(count($uri_arr) == 2){
            $get_params = explode('&', $uri_arr[1]);
            foreach($get_params as $get_v){
                $get_vs = explode('=', $get_v);
                $_GET[$get_vs[0]] = $get_vs[1];
            }
        }

        $uri = $uri_arr[0];
        $dir_name = explode('/', strtr(dirname(__FILE__, 2), array('\\' => '/')));
        $pop = array_pop($dir_name);
        if(preg_match('/^(\/'.$pop.')/', $uri)){
            $uri = strtr($uri, array('/'.$pop => ''));
        }

        $uri_arr = array();
        $dir = $file_name = '';
        $is_file = $is_dir = false;
        if($uri != '/'){
            $uri_arr = explode('/', $uri);
            array_shift($uri_arr);

            do{
                foreach($uri_arr as $k => $v){
                    $file_name = ucwords(strtolower($v)).'.controller.php';
                    $dir .= $v.'/';

                    if($is_dir == false && is_dir(DIR_CONTROLLER.$dir)){
                        $this->_set_dir($dir);
                        for($i = 0; $i <= $k; $i++){
                            unset($uri_arr[$i]);
                        }
                        $is_dir = true;
                    }
                    
                    if(is_file(DIR_CONTROLLER.$this->dir.$file_name)){
                        $this->_set_class($v);
                        unset($uri_arr[$k]);
                        $is_file = true;
                        break;
                    }
                }
            }while(0);
        }

        autoload($this->dir.$this->class);
        $classname = ucwords(strtolower($this->class));

        $action = 'Action_'.$classname;
        $class = new ReflectionClass($action);

        if(!empty($uri_arr) && method_exists($action, $uri_arr[0])){
            $this->_set_method(array_shift($uri_arr));
        }

        $instance = $class->newInstanceArgs();
        $method = $class->getmethod('run');

        $data = array(
            $class,
            $instance,
            $this->method,
            $uri_arr
        );
        $method->invokeArgs($instance, $data);
    }

    private function _set_class($class){
        $this->class = $class;
    }

    private function _set_method($method){
        $this->method = $method;
    }

    private function _set_dir($dir){
        $this->dir = $dir;
    }
}
