<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/25
 * Time: 10:31
 */

namespace app\index\controller;


use app\index\BaseController;
use app\index\ResponseCode;
use think\Request;

class Session extends BaseController
{
    /**
     * 注销退出
     * @return array|\think\Response
     */
    public function logout(){
        $accessKey = Request::instance()->get('ak');
        if ($this->getAuthTokenService()->logout($accessKey)){
            return response(ResponseCode::statusSuccess, '无法注销会话信息');
        } else {
            return response(ResponseCode::statusSuccess, '会话信息已经注销');
        }
    }

    private function getAuthTokenService(){
        return $this->createService('auth:AuthTokenService');
    }
}