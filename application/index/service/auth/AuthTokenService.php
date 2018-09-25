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

    public function checkAuth($authToken, $accessKey, $time, $url);

    public function login($username, $password);

    public function logout($accessKey);

    public function register($username, $password);

    public function getSessionKey($accessKey);

    public function expireSession($accessKey, $seconds);
}