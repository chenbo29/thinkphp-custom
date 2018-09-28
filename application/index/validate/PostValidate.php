<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/28
 * Time: 9:04
 */

namespace app\index\validate;


use think\Validate;

class PostValidate extends Validate
{
    protected $rule = [
        'title' => 'require',
        'content' => 'require'
    ];

    protected $message = [
        'title' => '文章标题必填',
        'content' => '文章内容必填',
    ];

    protected $scene = [
        'save' => [
            'title',
            'content'
        ]
    ];
}