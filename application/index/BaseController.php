<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 15:08
 */

namespace app\index;


use Pimple\Container;
use think\Config;
use think\Controller;
use think\Request;

/**
 * 基础控制器类
 * Class BaseController
 * @package app\index
 */
class BaseController extends Controller
{
    protected $container; //服务容器

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->container = new Container();
        // 判断请求是否需要安全验证
        if (!in_array(lcfirst(Request::instance()->controller()), Config::get('auth.except'))) {
            $authTokenService = $this->createService('auth:AuthTokenService');
            $authTokenService->checkAuth();
        }
    }

    /**
     * 获取某个service对象
     * @param $service
     * @return mixed
     */
    protected function createService($service){
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
}