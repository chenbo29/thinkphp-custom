<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 14:04
 */

namespace app\index\service\auth;

/**
 * 接口安全验证
 * Interface AuthTokenService
 * @package app\index\service\auth
 */
interface AuthTokenService
{
    public function generateASKey();

    public function checkAuth();

    public function login();
}