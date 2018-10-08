<?php

namespace app\index\controller;

use app\index\BaseController;
use app\index\ResponseCode;
use think\Controller;
use think\Request;

class User extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $mobile = $request->post('mobile');
        $type = $request->post('type');
        $password = $request->post('password');
        $ip = $request->ip(0);
        $fileds = [
            'mobile' => $mobile,
            'password' => $password,
            'type' => $type
        ];
        $registerValidateResult = validateCheck('UserValidate', $fileds, 'register');
        if ($registerValidateResult !== true){
            return response(ResponseCode::statusError, $registerValidateResult);
        }

        if ($this->getUserService()->ifRegistered($mobile)){
            return response(ResponseCode::statusError, '手机号码已经注册');
        }
        if ($this->getUserService()->register($mobile, $password, $type, $ip)){
            return response(ResponseCode::statusSuccess, '注册成功');
        } else {
            return response(ResponseCode::statusError, '注册失败');
        }
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

    private function getUserService(){
        return $this->kernel->createService('user:UserService');
    }
}
