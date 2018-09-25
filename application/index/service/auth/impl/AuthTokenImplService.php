<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 14:04
 */

namespace app\index\service\auth\impl;


use app\index\service\auth\AuthTokenService;
use app\index\service\BaseService;
use Predis\Client;
use Ramsey\Uuid\Uuid;
use think\Config;
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
     * @param $authToken 认证信息
     * @param $accessKey
     * @param $time 请求发起时间
     * @param $url 请求路由信息
     * @return bool|string
     */
    public function checkAuth($authToken, $accessKey, $time, $url)
    {
        if (!$this->redis->exists($this->getSessionKey($accessKey))){
            return '不存在会话信息';
        }

        if(empty($authToken)){
            return '安全验证信息为空';
        }

        if ($this->checkExpired($time)){
            return '过期'.time();
        }

        $redisData = json_decode($this->redis->get($this->getSessionKey($accessKey)), true);
        $secretKey = $redisData['secretKey'];
        $params = array_merge(Request::instance()->post(), Request::instance()->put());
        $expectAuthToken = $this->generateAuthToken($url, $secretKey, $time, $params);
        if ($authToken != $expectAuthToken){
            return '请求非法'.$expectAuthToken;
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
    public function login($username, $password){
        $user = $this->getUserModel()->where('username', $username)->where('password', $password)->find();
        if ($user){
            list($accessKey, $secretKey) = $this->generateASKey();
            $this->redis->set($this->getSessionKey($accessKey), json_encode(['username' => $username, 'secretKey' => $secretKey]), 'EX', Config::get('auth.session')['ttl']);
            return [$accessKey, $secretKey];
        } else {
            return false;
        }
    }

    /**
     * 退出
     * @param $accessKey
     * @return bool
     */
    public function logout($accessKey)
    {
        if ($this->container['redis']->del($this->getSessionKey($accessKey))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 注册
     * @param $username
     * @param $password
     * @return bool
     */
    public function register($username, $password)
    {
        $user = $this->getUserModel()->where('username', $username)->find();
        if ($user){
            return false;
        } else {
            $this->getUserModel()->username = $username;
            $this->getUserModel()->password = $password;
            return $this->getUserModel()->save();
        }
    }

    /**
     * 会话缓存中存储的key
     * @param $accessKey
     * @return string
     */
    public function getSessionKey($accessKey)
    {
        return "auth:{$accessKey}";
    }

    /**
     * 延期会话时间
     * @param $accessKey
     * @param $seconds
     * @return int
     */
    public function expireSession($accessKey, $seconds)
    {
        $redis = new Client();
        return $redis->expire($this->getSessionKey($accessKey), $seconds);
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

    private function getUserModel(){
        return $this->createModel('UserModel');
    }
}