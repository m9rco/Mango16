<?php

/**
 * main
 *
 * @author   Pu ShaoWei <pushaowei-hj@huajiao.tv>
 * @date     2017/7/10
 * @license  Mozilla
 */
class MainController extends InitController{

    public function indexAction(){
        $this->display('index');
    }

    public function contentAction(){
        echo 's';die;
    }
}