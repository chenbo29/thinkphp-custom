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
use think\Request;

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
        $username = Request::instance()->post('username');
        $password = Request::instance()->post('password');
        $result = $this->getAuthTokenService()->login($username, $password);
        if (is_array($result)){
            list($accessKey, $secretKey) = $result;
            return response(ResponseCode::statusSuccess, '登陆成功', ['accessKey' => $accessKey, 'secretKey' => $secretKey]);
        } else {
            return response(ResponseCode::statusError, $result);
        }
    }

    /**
     * 注册
     * @return array|\think\Response
     */
    public function register(){
        $username = Request::instance()->post('username');
        $password = Request::instance()->post('password');
        if ($this->getAuthTokenService()->register($username, $password)){
            return response(ResponseCode::statusSuccess, '注册成功');
        } else {
            return response(ResponseCode::statusError, '注册失败');
        }
    }

    private function getAuthTokenService(){
        return $this->createService('auth:AuthTokenService');
    }
}