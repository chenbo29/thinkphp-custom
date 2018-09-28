<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 15:31
 */

namespace app\index\command;


use app\index\Kernel;
use Pimple\Container;
use Predis\Client;
use think\Config;
use think\console\Command;

/**
 * 命令基础类
 * Class BaseCommand
 * @package app\index\command
 */
class BaseCommand extends Command
{
    protected $container;
    protected $kernel;
    protected $redis;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->container = new Container();
        $this->container['kernel'] = function ($container){
            return new Kernel($container);
        };
        $this->kernel = $this->container['kernel'];
        $this->container['redis'] = new Client(sprintf('tcp://%s:%s', Config::get('redis.host'), Config::get('redis.port')));
    }
}