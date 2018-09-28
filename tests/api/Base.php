<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/28
 * Time: 15:23
 */

class Base
{
    protected $accessKey;
    protected $time;

    protected function generateParamUrl($params = []){
        return http_build_query(['ak' => $this->accessKey, 'time' => $this->time]);
    }

    protected function getResult(ApiTester $api){
        return json_decode($api->grabResponse(), true);
    }
}