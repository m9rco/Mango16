<?php
use modules\Home\controllers\Traits\StaticConf;

/**
 * [init 初始化]
 * @return [type] [description]
 */
class InitController  extends BaseController{
   use StaticConf;
   public function init(){
     parent::init();
      $node_case = strtolower($this->_controller . '.' . $this->_action);
      if ( !$this->_req->isXmlHttpRequest())
      {
          $options = $this->options($node_case);
          $this->assign('options', $options);
      }
   }
}
