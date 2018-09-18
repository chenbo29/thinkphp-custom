<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 16:30
 */

namespace app\index\behavior;


use think\Log;
use think\Request;
use think\Response;

class Auth
{
    public function run(&$params){
        Log::info('行为11');
        $auth = new \app\index\service\Auth(Request::instance());
        $auth->verify();
        return false;
    }
}