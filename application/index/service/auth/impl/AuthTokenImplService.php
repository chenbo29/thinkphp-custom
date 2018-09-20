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
use Ramsey\Uuid\Uuid;
use think\Request;

/**
 * 接口安全验证类
 * Class AuthTokenImplService
 * @package app\index\service\auth\impl
 */
class AuthTokenImplService extends BaseService implements AuthTokenService
{
    private $expiredTime = 3600;
    /**
     * 接口安全验证
     * @return bool
     */
    public function checkAuth()
    {
        header('Content-Type: application/json');
//        todo 验证auth-token的逻辑
        $authToken = Request::instance()->header('Auth-Token');
        $accessKey = Request::instance()->get('ak');
        $time = Request::instance()->get('time', 0);
        $path = Request::instance()->path();

        if (!$redisData = $this->redis->get("auth:{$accessKey}")){
            die(json_encode(['code' => responseCode::statusError, 'msg' => '不存在会话信息']));
        }

        if(empty($authToken)){
            die(json_encode(['code' => responseCode::statusError, 'msg' => '安全验证信息为空']));
        }

        if ($this->checkExpired($time)){
            die(json_encode(['code' => responseCode::statusError, 'msg' => '过期'.time()]));
        }

        $redisData = json_decode($redisData, true);
        $secretKey = $redisData['secretKey'];
        $expectAuthToken = $this->generateAuthToken($path, $secretKey, $time, Request::instance()->post());
        if ($authToken != $expectAuthToken){
            die(json_encode(['code' => responseCode::statusError, 'msg' => '请求非法'.$expectAuthToken]));
        }

        return true;
    }

    /**
     * 生成access Key和 secret Key
     * @return array
     * @throws \Exception
     */
    public function generateASKey()
    {
        $accessKeyUuid = Uuid::uuid4();
        $secretKeyUuid = Uuid::uuid4();
        $accessKey = $accessKeyUuid->toString();
        $secretKey = $secretKeyUuid->toString();
        return [$accessKey, $secretKey];
    }

    /**
     * 登陆
     * @return array
     * @throws \Exception
     */
    public function login(){
        $username = Request::instance()->post('username');
        $password = Request::instance()->post('password');
//        todo
        list($accessKey, $secretKey) = $this->generateASKey();
        $this->redis->set("auth:{$accessKey}", json_encode(['username' => $username, 'secretKey' => $secretKey]));
        return [$accessKey, $secretKey];
    }

    /**
     * auth-token的创建
     * @param $routePath
     * @param $secretKey
     * @param $time
     * @param string $bodyParams
     * @return string
     */
    private function generateAuthToken($routePath, $secretKey, $time, $bodyParams = ''){
        $params = [
            $routePath,
            $secretKey,
            json_encode($bodyParams),
            $time
        ];
        return hash('sha256', join(':', $params));
    }

    /**
     * 有效期
     * @param $time
     * @return bool
     */
    private function checkExpired($time){
        return ($time + $this->expiredTime) < time();
    }
}