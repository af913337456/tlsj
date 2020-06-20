<?php

use think\facade\Route;

Route::domain('2019demo_api', function () {
    Route::group(':version', function () {
        Route::group('user', function () {
            // 获取会员信息
            Route::get('getUserInfo', 'api/:version.User/getUserInfo');
            Route::post('getUserInfo', 'api/:version.User/getUserInfo');
            // 会员登录
            Route::post('login', 'api/:version.Login/doLogin');
            // 会员退出
            Route::post('logout', 'api/:version.User/logout');
            // 会员注册
            Route::post('reg', 'api/:version.Reg/doReg');
            // 会员修改头像
            Route::post('modifyAvatar', 'api/:version.User/modifyAvatar');
        });

        // 发送手机验证码
        Route::post('sendPhoneVerifyCode', 'api/:version.Code/sendVerifyCodeByPhone');

        Route::group('money', function () {
            // 获取钱包日志
            Route::get('getMoneyLog', 'api/:version.Money/getMoneyLog');
        });

        Route::group('config', function () {
            // 检测是否有新版本
            Route::post('checkUpdate', 'api/:version.Config/checkUpdate');
        });


        Route::group('news', function () {
            // 新闻分类
            Route::get('getCategoryList', 'api/:version.News/getCategoryList');
            Route::post('getCategoryList', 'api/:version.News/getCategoryList');
            // 新闻列表
            Route::get('getList', 'api/:version.News/getList');
            Route::post('getList', 'api/:version.News/getList');
            // 新闻详情
            Route::get('detail', 'api/:version.News/detail');
            Route::post('detail', 'api/:version.News/detail');
        });
    })->middleware([
        'app\\api\\middleware\\CheckToken'
    ]);
    // api文档
    Route::get('document/e80b5017098950fc58aad83c8c14978e', 'api/Index/document');
    Route::miss(function () {
        if (\think\facade\Request::isPost()) {
            return \think\facade\Response::code(404)->send();
        }
        return '<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>404</title>
		<meta name="renderer" content="webkit" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<!--[if lte IE 8]> <script> location = "/ie.html?url=" + encodeURIComponent(location.href); </script> <![endif]-->
		<style>
			*{ padding:0; margin:0; box-sizing: border-box;font-family: "微软雅黑"; }
			body,html{ width:100%; height:100%; }
			img{ -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
			.container{ max-width:90%; margin:0 auto; padding:80px 0px; }
			.bg{ display:block; max-width:100%; margin:0px auto; }
		</style>
	</head>
	<body>
		<div class="container">
			<img src="data:image/png;base64,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" class="bg" />
		</div>
	</body>
</html>';
    });
})->bind('api')->header([
    'Access-Control-Allow-Origin' => '*',
    'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
    'Access-Control-Allow-Credentials' => false,
    'Access-Control-Allow-Headers' => 'Content-Type, X-Requested-With, Cache-Control,token,language'
])->allowCrossDomain();