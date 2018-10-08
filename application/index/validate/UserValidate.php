<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 15:14
 */

namespace app\index\validate;


use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'mobile' => 'require',
        'code' => 'require',
        'password' => 'require|min:6|max:32'
    ];

    protected $message = [
        'mobile.require' => '手机号不能为空',
        'code.require' => '验证码不能为空',
        'password.require' => '密码不能为空',
        'password.max' => '密码不能超过32个字符',
        'password.min' => '密码不能小于6个字符'
    ];

    protected $scene = [
        'save' => [
            'mobile', 'code', 'password'
        ]
    ];
}