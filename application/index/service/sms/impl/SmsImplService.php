<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 15:18
 */

namespace app\index\service\sms\impl;


use app\index\service\BaseService;
use app\index\service\sms\SmsService;
use think\Exception;

class SmsImplService extends BaseService implements SmsService
{
    protected $ttl = 120;

    public function sendCode($mobile, $type)
    {
        $code = $this->generateCode($mobile, $type);
        switch ($type){
            case 'register':
                // todo 短信验证码发送
                break;
            default:
                throw new Exception('不存在的发送场景');
        }
        return true;
    }

    public function verifyCode($phone, $code)
    {
        // TODO: Implement verifyCode() method.
    }

    private function generateCode($mobile, $type){
        $code = 123456;
        if ($this->redis->setex("sms:code:{$type}:{$mobile}", $this->ttl, $code)){
            return $code;
        } else {
            throw new Exception('短信验证码创建失败');
        }
    }

}