<?php
/**
 * yaf 框架报错类调用
 *  默认错误会调用这个Controller 中 ErrorAction
 */
class ErrorController extends Yaf\Controller_Abstract {
    private $_config;
/*    public function init(){
        $this->_config = Yaf\Application::app()->getConfig();
    }*/
    /**
     * [具体错误处理]
     * @param  Exception $exception [description]
     * @return [type]               [description]
     */
    public function errorAction(Exception $exception)
    {
        Yaf\Dispatcher::getInstance()->autoRender(false);
        $code = $exception->getCode();
        $message = $exception->getMessage();
        $module = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action = $this->getRequest()->getActionName();
    var_dump($message);die;
    }
}
