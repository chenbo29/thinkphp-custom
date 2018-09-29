<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/28
 * Time: 15:23
 */

use Codeception\Module\Db;
use Codeception\Module\Redis;
class Base
{
    protected $username = 'test';
    protected $password = '123456';
    protected $accessKey = "testAccessKey";
    protected $secretKey = "testSecretKey";

    /**
     * api接口请求默认统一的参数
     * @param array $params
     * @return string
     */
    protected function generateParamUrl($params = []){
        $baseParams = ['ak' => $this->accessKey, 'time' => time()];
        $httpParams = array_merge($params, $baseParams);
        return http_build_query($httpParams);
    }

    /**
     * 获取接口返回的结果内容
     * @param ApiTester $api
     * @return array
     */
    protected function getResult(ApiTester $api){
        return json_decode($api->grabResponse(), true);
    }

    /**
     * 初始化一个用户
     * @param Db $db
     * @return array
     */
    protected function initUser(Db $db){
        $user = [
            'username' => $this->username,
            'password' => password_hash($this->password, PASSWORD_BCRYPT)
        ];
        $db->haveInDatabase('user', $user);
        return [$this->username, $this->password];
    }

    /**
     * 初始化用户的会话信息
     * @param Redis $redis
     * @throws \Codeception\Exception\ModuleException
     */
    protected function initUserSession(Redis $redis){
        $redis->haveInRedis('string',"auth:{$this->accessKey}", json_encode(['username' => $this->username, 'secretKey' => $this->secretKey]));
    }
}