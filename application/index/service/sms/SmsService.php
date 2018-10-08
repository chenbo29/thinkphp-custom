<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 15:17
 */

namespace app\index\service\sms;


interface SmsService
{
    public function sendCode($phone, $type);

    public function verifyCode($phone, $code);
}