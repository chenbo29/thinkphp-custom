<?php

namespace app\index\controller;

use app\index\BaseController;
use app\index\ResponseCode;
use think\Exception;
use think\Log;
use think\Request;

class Sms extends BaseController
{
    /**
     * 生成并发送短信验证码
     * @param Request $request
     * @return array|\think\Response
     */
    public function send(Request $request)
    {
        $mobile = $request->post('mobile');
        $type = $request->post('type');
        if ($type !== 'register'){ $this->auth(); }
        $smsSendValidateResult = validateCheck('SmsValidate', ['mobile' => $mobile, 'type' => $type], 'send');
        if ($smsSendValidateResult !== true){
            return response(ResponseCode::statusError, $smsSendValidateResult);
        }
        try{
            $result = $this->getSmsService()->sendCode($mobile, $type);
            if ($result){
                return response(ResponseCode::statusSuccess, '验证码发送成功');
            } else {
                return response(ResponseCode::statusError, '验证码发送失败');
            }
        } catch (Exception $e){
            Log::error($e->getMessage());
            return response(ResponseCode::statusError, '服务异常');
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

    private function getSmsService(){
        return $this->kernel->createService('sms:SmsService');
    }
}
