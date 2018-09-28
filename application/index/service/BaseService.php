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
    protected $kernel;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->redis = $container['redis'];
        $this->kernel = $container['kernel'];
    }
}