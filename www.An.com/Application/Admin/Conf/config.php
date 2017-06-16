<?php
return array(
	//'配置项'=>'配置值'
		
		/*公共样式设置*/
		'TMPL_PARSE_STRING' =>array(
			'__PUBLIC__'	=>	'/Public/Admin/',
			'__UPLOAD__'		=>	'/Uploads',
			),



	    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'mydb',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    	/*数据库设置*/


    	/* 模版布局*/
    	'LAYOUT_ON' => true, //打开模版布局
    	'LAYOUT_NAME' => 'layout/index', //布局文件名称
    	/* 模版布局*/

        /* 路径布局*/
        'URL_MODEL'             => 2,
        'URL_CASE_INSENSITIVE' =>true, //布局文件名称
        /* 路径布局*/
);