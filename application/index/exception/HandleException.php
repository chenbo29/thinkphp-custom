<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 15:01
 */

namespace app\index\exception;


use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;

class HandleException extends \think\exception\Handle
{
    public function render(\Exception $e)
    {
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json($e->getError(), 422);
        }

        // 请求异常
        if ($e instanceof HttpException && request()->isAjax()) {
            return response($e->getStatusCode(), $e->getMessage());
        }

        return Response::create(['msg' => '系统抛出异常信息'], 'json', 500);
    }
}