# YafUse - I Use Yaf!
Yaf 地址:https://github.com/laruence/php-yaf 请针对自己的php 版本进行安装,注意服务器url路由规则

## What I Do
- layout布局实现
- bootstrap 后台管理界面
- PDO数据库操作类(Mysql数据主从实现)
- 简单的增删改查实现
- 错误捕捉显示及日志记录

## Requirement
- Nginx
- PHP 7 +
- Mysql

```
server {
  listen ****;
  server_name  domain.com;
  root   document_root;
  index  index.php index.html index.htm;
 
  location / {
		try_files $uri $uri/ /index.php?$args;
  }

}
```

