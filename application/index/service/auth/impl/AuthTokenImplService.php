<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 14:04
 */

namespace app\index\service\auth\impl;


use app\index\responseCode;
use app\index\service\auth\AuthTokenService;
use app\index\service\BaseService;
use think\Request;

class AuthTokenImplService extends BaseService implements AuthTokenService
{
    public function checkAuth()
    {
//        todo 验证auth-token的逻辑
        $authToken = Request::instance()->header('Auth-Token');
        if(empty($authToken)){
            header('Content-Type: application/json');
            die(json_encode(['code' => responseCode::statusError, 'msg' => '安全验证信息为空']));
        } else {
            return true;
        }
    }
}