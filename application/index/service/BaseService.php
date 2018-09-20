<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 9:46
 */

namespace app\index\service;

use Pimple\Container;

/**
 * 基础service类
 * Class BaseService
 * @package app\index\service
 */
class BaseService
{
    protected $container;
    protected $redis;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->redis = $container['redis'];
    }

    /**
     * 获取模型对象（载入服务容器中）
     * @param $model
     * @return mixed
     */
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