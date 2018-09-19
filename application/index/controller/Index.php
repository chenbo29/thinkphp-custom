<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 14:42
 */

namespace app\index\controller;


use app\index\responseCode;
use think\Controller;

class Index extends Controller
{
    public function miss(){
        return response(responseCode::statusNotFound, '请求地址不存在');
    }
}