# Mango16 - 基于Yaf的Cmf管理系统

![image](http://static.mango16.cc/WechatIMG29.png)

> 知行合一，学以致用 集合众多`Web`开发新特性 ，来一起堆轮子吧

Centos7.0 + PHP7.1 + Yaf 3.0.4 快速搭建高速的Lnmp栈，作为平时班后练习。[静态资源](https://github.com/PuShaoWei/Mango16-static)

## What I Do
- 基于zui的后台管理界面
- 引入 laravel 中的 Eloquent
- 简单的增删改查实现
- 错误捕捉显示及日志记录
- 静态资源采用第三方[七牛云](http://www.qiniu.com/?utm_campaign=baiduSEM&utm_source=baiduSEM&utm_medium=baiduSEM&utm_content=baiduSEM)托管
- Composer管理包依赖

## Requirement
- [Nginx](http://nginx.org/)
- [PHP 7 +](http://php.net/manual/zh/migration71.new-features.php)
- [MariaDB](https://www.zhihu.com/question/41832866)
- [YaConf](http://pecl.php.net/package/yaconf)
- [Yaf 3.0+](http://pecl.php.net/package/yaf)
- [Zui 1.5.0](http://www.zui.sexy/#/)
- [Eloquent 4.2](https://lvwenhan.com/laravel/421.html)
- [Composer 1.0](http://pkg.phpcomposer.com/)

## The last

不太懂你的思想，我们只是最快的框架

**Nginx 示例**

```
server {
    listen 80;
    server_name  ***;
    root  ***;
    access_log   ***/nginx/logs/space-access-log main;
    error_log    ***/nginx/logs/space-error-log   error;
    location / {
            index index.php index.html;
            try_files $uri $uri/ /index.php?$args;
    }
    location ~ .*\.php$ {
            include /root/nginx/conf/fastcgi.9000.conf;
            fastcgi_param  SCRIPT_FILENAME  ***/$fastcgi_script_name;
    }
}

```

**php.ini**


```
extension="yaf.so"
extension="yaconf.so"
yaf.environ = product
yaf.library = NULL
yaf.cache_config = 0
yaf.name_suffix = 1
yaf.name_separator = ""
yaf.forward_limit = 5
yaf.use_namespace = 1
yaf.use_spl_autoload = 0
yaconf.directory=***/Mango16/config

```

## 纠错

如果大家发现有什么不对的地方，可以发起一个[issue](https://github.com/PuShaoWei/Mango16/issues)或者[pull request](https://github.com/PuShaoWei/Mango16/pulls),我会及时纠正

> 补充:发起pull request的commit message请参考文章[Commit message 和 Change log 编写指南](http://www.ruanyifeng.com/blog/2016/01/commit_message_change_log.html)

## 感谢

感谢以下朋友的issue或pull request：

- [zhangxuanru](https://github.com/zhangxuanru)
