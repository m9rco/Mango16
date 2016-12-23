<?php 
class BaseController extends Yaf\Controller_Abstract 
{
    protected  $_req;
    protected  $_module;
    protected  $_controller;
    protected  $_action;

    protected static $instance = [];
	public function init()	
	{
        $this->_req = $this->getRequest();
        $this->_module 	   = $this->_req->getModuleName();
        $this->_controller = $this->_req->getControllerName();
        $this->_action	   = $this->_req->getActionName();
	}

	/**
	 * [assign 完全偷懒]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2016-12-22T18:57:09+0800
	 * @param                               [type] $key   [description]
	 * @param                               [type] $value [description]
	 * @return                              [type]        [description]
	 */
	protected function assign($key,$value)
	{
		return $this->getView()->assign($key,$value);
	}

	/**
	 * [getInstance 数据库实例]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2016-12-22T19:31:58+0800
	 * @param                               [type] $table_name [description]
	 * @return                              [type]             [description]
	 */
	protected function getInstance($table_name='',$mark = false)
	{
        try{
            if($mark == true)
	           	 $class = 'models\\'.$this->_module .'\\'.$this->_action.'\\'.$table_name;   
            else
	           	 $class = 'models\\'.$this->_module .'\\'.$table_name;   
	        // 初始化
            if ( !isset(self::$instance[$table_name]) ) {
                self::$instance[$table_name] = new $class;
            }
            return self::$instance[$table_name];
        } catch (Exception $e) {
            echo $e->getMessage();die;
        }
	}
}