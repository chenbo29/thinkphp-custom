<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/28
 * Time: 10:26
 */

namespace app\index;


use Pimple\Container;

class Kernel
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function createService($service){
        if (!isset($this->container[$service])){
            $serviceParams = explode(':', $service);
            $serviceModule = $serviceParams[0];
            preg_match("/(.*)Service$/", $serviceParams[1], $matches);
            $serviceClass = "{$matches[1]}ImplService";
            $stdClass = __NAMESPACE__ . "\\service\\$serviceModule\\impl\\$serviceClass";
            $this->container[$service] = function ($container) use($stdClass) {
                return new $stdClass($container);
            };
        }
        return $this->container[$service];
    }

    public function createModel($model){
        if (!isset($this->container[$model])){
            preg_match("/(.*)Model$/", $model, $matches);
            $serviceClass = "{$matches[1]}ImplModel";
            $stdClass = __NAMESPACE__ . "\\model\\impl\\$serviceClass";
            $this->container[$model] = new $stdClass();
        }
        return $this->container[$model];
    }
}