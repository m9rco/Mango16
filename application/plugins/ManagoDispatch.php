<?php

use library\Base\Tools;

/**
 * 芒果分发插件
 * @author : pushaowei@sporte.cn
 * @create : 2016-12-20 
 */
class ManagoDispatchPlugin extends Yaf\Plugin_Abstract {

	public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) 
	{
		// 设置请求方式 1 pc浏览器, 2 手机浏览器, 3 微信
		$request_method = Tools::is_mobile_request() ? ( ( Tools::is_weixin_request() ? 'WEIXIN' : 'WAP' ) ) : 'PC';
		$request->request_method = $request_method;
	}

	public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) 
	{
		$module = $request->getModuleName();
		// 模块有各自的BaseController ======================================================
		$loader = Yaf\Loader::getInstance();
		$loader->autoload('modules\\' . ucfirst($module) . '\\controllers_Init');
	}

	public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}

	public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}

	public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}

	public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}
}
