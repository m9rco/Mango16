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
     * 登录
     *
     */
	public function indexAction()
    {
        if($this->_req->isPost()){
            $post = $this->_req->getPost();
            if( $post['username'] == $post['password'] ){
                $this->success('登录成功，正在进入系统...','main/index');
            }
        }
        $this->display('login');
    }
}
