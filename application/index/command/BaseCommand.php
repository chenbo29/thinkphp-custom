<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 15:31
 */

namespace app\index\command;


use Pimple\Container;
use think\console\Command;

class BaseCommand extends Command
{
    protected $container;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->container = new Container();
    }

    protected function createService($service){
        if (!isset($this->container[$service])){
            $serviceParams = explode(':', $service);
            $serviceModule = $serviceParams[0];
            preg_match("/(.*)Service$/", $serviceParams[1], $matches);
            $serviceClass = "{$matches[1]}ImplService";
            $stdClass = "app\\index\\service\\$serviceModule\\impl\\$serviceClass";
            $this->container[$service] = function ($container) use($stdClass) {
                return new $stdClass($container);
            };
        }
        return $this->container[$service];
    }

    public function createModel($model){
        // todo 同BaseService相同
        if (!isset($this->container[$model])){
            preg_match("/(.*)Model$/", $model, $matches);
            $serviceClass = "{$matches[1]}ImplModel";
            $stdClass = "app\\index\\model\\impl\\$serviceClass";
            $this->container[$model] = function ($container) use($stdClass) {
                return new $stdClass();
            };
        }
        return $this->container[$model];
    }
}