<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 14:42
 */

namespace app\index\controller;


use app\index\BaseController;
use app\index\ResponseCode;

/**
 * Class Index
 * @package app\index\controller
 */
class Index extends BaseController
{
    /**
     * 配置Route::miss 请求地址路由未配置处理方法
     * @return array|\think\Response
     */
    public function miss(){
        return response(ResponseCode::statusNotFound, '请求地址不存在');
    }

    /**
     * 登陆
     * @return array|\think\Response
     */
    public function login(){
        // todo 登陆密码的验证处理
        list($accessKey, $secretKey) = $this->getAuthTokenService()->login();
        return response(ResponseCode::statusSuccess, '', ['accessKey' => $accessKey, 'secretKey' => $secretKey]);
    }

    private function getAuthTokenService(){
        return $this->createService('auth:AuthTokenService');
    }
}