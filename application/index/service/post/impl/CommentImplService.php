<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 13:25
 */

namespace app\index\service\post\impl;


use app\index\service\BaseService;
use app\index\service\post\CommentService;
use think\Log;

class CommentImplService extends BaseService implements CommentService
{
    public function __construct()
    {
        Log::info('comment被实例化');
    }

    public function test($content){
        Log::info("评论的内容$content");
    }
}