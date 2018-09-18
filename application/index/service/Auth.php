<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 15:15
 */

namespace app\index\service;


use Ramsey\Uuid\Uuid;
use think\Log;
use think\Request;

class Auth
{
    private $authToken;
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->authToken = $request->header('Auth-Token');
    }

    public function verify(){
        $params = $this->request->param();
        $authToken = $this->request->header('Auth-Token');
        //todo 接口签名校验
        Log::info('行为行为1');
        return true;
    }

    public static function generateASKey(){
        $accessKeyUuid = Uuid::uuid4();
        $secretKeyUuid = Uuid::uuid4();
        return [$accessKeyUuid->toString(), $secretKeyUuid->toString()];
    }
}