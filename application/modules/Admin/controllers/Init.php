<?php
use modules\Admin\controllers\Traits\StaticConf;
/**
 * [后台初始化]
 * @author Shaowe Pu 
 */
class InitController  extends BaseController
{
   use StaticConf;
   public function init()
   {
    		parent::init();
   	    $node_case = strtolower($this->_controller . '.' . $this->_action);
        if ( !$this->_req->isXmlHttpRequest()) 
        {
            $options = $this->options($node_case);
            $this->assign('options', $options);
        }
        $this->assign('controller', $this->_controller);
   }
}
