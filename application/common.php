<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function response($code, $message, $data = []){
    return ['code' => $code, 'msg' => $message, 'data' => $data];
}

function validateCheck($validateName, $data, $scene = null){
    $validate = \think\Loader::validate($validateName);
    if ($scene){
        $validate->scene($scene);
    }
    $result = $validate->check($data);
    if ($result){
        return true;
    } else {
        return $validate->getError();
    }
}