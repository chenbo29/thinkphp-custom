<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// 获取验证码
Route::post('sms','index/Sms/send');


// 注册
Route::post('register','index/Index/register');
// 登陆
Route::post('login','index/Index/login');
// 推出登陆状态
Route::get('logout','index/Session/logout');
// 文章的资源管理路由
Route::resource('post','index/Post', ['except'=>['create', 'edit']]);

//Route::resource('postsecond','second/Post', ['except'=>['create', 'edit']]);
// 没有匹配到所有的路由规则后执行的路由
Route::miss('miss');
return [];
