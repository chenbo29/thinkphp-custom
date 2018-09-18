<?php

namespace app\index\controller;

use app\index\BaseController;
use app\index\service\Auth;
use think\Controller;
use think\Request;

class Blog extends Controller
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

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        list($accessKey, $secretKey) = Auth::generateASKey();
        return ['name' => 'test', 'accessKey' => $accessKey, 'secretKey' => $secretKey];
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return ['code' => 200];
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
