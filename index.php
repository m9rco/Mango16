<?php
// +----------------------------------------------------------------------
// | Manago 16 
// +----------------------------------------------------------------------
// | Copyright (c) 2016 
// +----------------------------------------------------------------------
// | Licensed 
// +----------------------------------------------------------------------
// | @author: Shaowei Pu <pushaowei@sporte.cn>
// +----------------------------------------------------------------------
define('APPLICATION_PATH',dirname(__FILE__));
// 拒绝严格检查 || 有个版本错误，还没解决完呢
error_reporting(E_ALL || E_STRICT);
//Strict Standards: Yaf\Loader::autoload(): Could not find class modules_Home_controllers_Init in /home/Manago16/webroot/Manago16/application//modules/Home/controllers/Init.php in /home/Manago16/webroot/Manago16/application/plugins/ManagoDispatch.php on line 17
$application = new Yaf\Application( APPLICATION_PATH . "/config/Mapplication.ini");
$application->bootstrap()->run();


?>
