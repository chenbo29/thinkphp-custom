<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 15:08
 */

namespace app\index;


use Pimple\Container;
use think\Controller;
use think\Request;

class BaseController extends Controller
{
    protected $container;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->container = new Container();
    }

    protected function createService($service){
        if (!isset($this->container[$service])){
            $serviceParams = explode(':', $service);
            $serviceModule = $serviceParams[0];
            preg_match("/(.*)Service$/", $serviceParams[1], $matches);
            $serviceClass = "{$matches[1]}ImplService";
            $stdClass = __NAMESPACE__ . "\\service\\$serviceModule\\impl\\$serviceClass";
            $this->container[$service] = new $stdClass();
        }
        return $this->container[$service];
    }

    protected function createModel($model){

    }
}