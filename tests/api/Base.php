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

    public function __construct()
    {
        $databaseConfig = require dirname(__DIR__) . '/../application/database.php';
        $this->initDumpDBStructure($databaseConfig['hostname'], $databaseConfig['username'], $databaseConfig['password'], $databaseConfig['database']);
    }

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
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
            'create_time' => time(),
            'update_time' => time(),
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

    protected function initDumpDBStructure($host, $user, $password, $database){
        $process = new \Symfony\Component\Process\Process(array('mysqldump','-h', $host, '-u', $user, "-p{$password}", '-d', $database));
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \Symfony\Component\Process\Exception\ProcessFailedException($process);
        }
        file_put_contents(dirname(__DIR__) . '/_data/dump.sql', $process->getOutput());
        return true;
    }
}