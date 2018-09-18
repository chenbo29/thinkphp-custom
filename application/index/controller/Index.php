<?php
namespace app\index\controller;

use app\index\ServiceKernel;
use think\Controller;
use think\Request;

class Index extends Controller
{
    protected $beforeActionList = [
        'checksession', //在任何操作执行前执行checksession方法
//        'islogin' =>  ['except'=>'login'],   //在除login之外的其他方法执行前先执行islogin方法
//        'removesession'  =>  ['only'=>'logout'],   //在logout执行前先执行removesession
    ];

    public function checksession()
    {
        return false;
    }


    public function index()
    {
        $this->getPostService()->getById(1);
        return $this->getPostService()->getById(1);
        return ['code' => 200, 'data' => ['name' => 'test'], 'post' => Request::instance()->isPost(), 'get' => Request::instance()->isGet()];
    }

    public function index_post_json()
    {
        return ['code' => 200, 'data' => ['name' => 'test'], 'post' => Request::instance()->isPost(), 'get' => Request::instance()->isGet()];
    }

    public function index_put_json()
    {
        return ['code' => 200, 'data' => ['name' => 'test'], 'post' => Request::instance()->isPost(), 'get' => Request::instance()->isGet()];
    }

    public function index_delete_json()
    {
        return ['code' => 200, 'data' => ['name' => 'test'], 'post' => Request::instance()->isPost(), 'get' => Request::instance()->isGet()];
    }

    private function getPostService(){
        return ServiceKernel::create('Post');
    }
}
