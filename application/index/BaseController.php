<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 15:08
 */

namespace app\index;


use app\index\service\auth\impl\AuthTokenImplService;
use Pimple\Container;
use Predis\Client;
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
    protected $kernel;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->container = new Container();
        $this->container['kernel'] = function ($container){
            return new Kernel($container);
        };
        $this->kernel = $this->container['kernel'];
        $this->container['redis'] = new Client(sprintf('tcp://%s:%s', Config::get('redis.host'), Config::get('redis.port')));
        // 判断请求是否需要安全验证
        if (!in_array(lcfirst(Request::instance()->controller()), Config::get('auth.except'))) {
            $authTokenService = new AuthTokenImplService($this->container);
            $authToken = Request::instance()->header('Auth-Token');
            $accessKey = Request::instance()->get('ak');
            $time = Request::instance()->get('time', 0);
            $url = Request::instance()->url();
            $result = $authTokenService->checkAuth($authToken, $accessKey, $time, $url);
            if ($result !== true){
                header('Content-Type: application/json');
                die(json_encode(['code' => ResponseCode::statusError, 'msg' => $result]));
            } else {
                $authTokenService->expireSession($accessKey, Config::get('auth.session')['ttl']);
            }
        }
    }
}