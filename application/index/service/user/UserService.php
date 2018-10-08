<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 16:35
 */

namespace app\index\service\user;


interface UserService
{
    public function ifRegistered($mobile);
    public function register($mobile, $password, $type);
}