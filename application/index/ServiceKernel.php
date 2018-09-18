<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 16:49
 */

namespace app\index;


use Pimple\Container;

class ServiceKernel
{
    public static function create(string $stdClass){
        //todo
        $container = new Container();
        if (isset($container[$stdClass])){
            Log::info('测试');
            return $container[$stdClass];
        } else {
            $container[$stdClass] = function ($c) use ($stdClass) {
                $stdClass = "app\\index\\service\\impl\\{$stdClass}ImplService";
                return new $stdClass();
            };
            return $container[$stdClass];
        }
    }
}