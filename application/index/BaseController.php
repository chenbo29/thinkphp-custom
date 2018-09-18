<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/17
 * Time: 15:08
 */

namespace app\index;


use app\index\service\Auth;
use think\Controller;
use think\Log;
use think\Request;
use think\Response;
use think\response\Json;

class BaseController extends Controller
{
    protected $beforeActionList = [
        'auth'
    ];
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        Log::record(print_r($request->header('Auth-Token'), true));
    }

    protected function auth(){
        $auth = new Auth($this->request);
        $result = $auth->verify();
        return ['code' => 401];
    }

    public function _initialize()
    {
        return ['code' => 401];
    }
}