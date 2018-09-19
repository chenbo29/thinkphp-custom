<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 9:46
 */

namespace app\second\service;

class BaseService
{
    protected $container;

//    public function __construct($container)
//    {
//        $this->container = $container;
//    }

    public function createModel($model){
        if (!isset($this->container[$model])){
            preg_match("/(.*)Model$/", $model, $matches);
            $serviceClass = "{$matches[1]}ImplModel";
            $stdClass = "app\\index\\model\\impl\\$serviceClass";
            $this->container[$model] = new $stdClass();
        }
        return $this->container[$model];
    }
}