<?php

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

//define('BIND_MODULE', 'User');
//define('BIND_MODULE', 'Api');
//define('BIND_MODULE', 'Auth');
//define('BIND_MODULE', 'MessageService');

// 定义应用目录
define('APP_PATH','./Application/');

// 定义runtime的路径
define('RUNTIME_PATH','./Data/Runtime/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
?>