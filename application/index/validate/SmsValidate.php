<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 15:30
 */

namespace app\index\validate;


use think\Validate;

class SmsValidate extends Validate
{
    protected $rule = [
        'phone' => 'require|phone',
        'type' => 'require|sendType',
    ];

//    protected $regex = [
//        'phone' => "^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0-9]|18[0|1|2|3|5|6|7|8|9])\d{8}$"
//    ];

    protected $regex = [
        'phone'=>'/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|16[6]|(17[0,3,5-8])|(18[0-9])|19[89])\d{8}$/',
    ];

    protected $scene = [
        'send' => ['phone', 'type']
    ];

    protected function sendType($value){
        if (in_array($value, ['register'])){
            return true;
        } else {
            return '发送短信息的场景不存在';
        }
    }
}