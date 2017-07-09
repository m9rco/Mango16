<?php
use library\Core\Tools;

/**
 * 芒果分发插件
 * @author : pushaowei@sporte.cn
 * @create : 2016-12-20
 */
class ManagoDispatchPlugin extends Yaf\Plugin_Abstract {
    /**
     * 路由开始
     *
     * @param \Yaf\Request_Abstract  $request
     * @param \Yaf\Response_Abstract $response
     */
	public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
	{
	    $host               =  explode( '.',$request->getServer('HTTP_HOST'));
        $request->setModuleName(ucwords($host[0]));

        // 设置请求方式 1 pc浏览器, 2 手机浏览器, 3 微信
		//$request_method = Tools::is_mobile_request() ? ( ( Tools::is_weixin_request() ? 'WEIXIN' : 'WAP' ) ) : 'PC';
		//$request->request_method = $request_method;
	}

	public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
	{
		$module = $request->getModuleName();
		// 模块有各自的BaseController ======================================================
		\Yaf\Loader::import(dirname(dirname(__FILE__)).'/modules/' . ucfirst($module) . '/controllers/Init.php');
		// $loader = Yaf\Loader::getInstance();
		// $loader->autoload('modules\\' . ucfirst($module) . '\\controllers_Init');
	}

	public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
//		if( $request->isPost() && $request->isXmlHttpRequest() )
//		{
//			$module = $request->getModuleName();
//			$class  = 'modules\\' . ucfirst($module) . '\\controllers\\Helper\\ValidateHelper';
//			$action = $request->getActionName().'Validate';
//			// if (!headers_sent()){
//			// 	header("Content-Type: application/json; charset=utf-8");
//			// }
//			$v_obj  = new $class;
//			echo $v_obj->$action( $request->getPost() ); exit;
//		}
	}

	public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}

	/**
	 * [postDispatch Post数据处理]
	 * @param  YafRequest_Abstract  $request  [description]
	 * @param  YafResponse_Abstract $response [description]
	 * @return [type]                         [description]
	 */
	public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}

	public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}
}
