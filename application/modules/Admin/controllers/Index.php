<?php
use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * IndexController
 *
 * @uses InitController
 * @version ${Id}$
 * @author Shaowei Pu <pushaowei@sporte.cn>
 */

class IndexController extends InitController{


	/**
	 * [loginAction 登录]
	 * @author 		Shaowei Pu <pushaowei@sporte.cn>
	 * @CreateTime	2016-12-22T18:33:55+0800
	 * @return                              [type] [description]
	 */
	public function loginAction()
	{
			$this->display('login');
	}
}
