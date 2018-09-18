<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:13
 */

namespace app\index\service\impl;



use app\index\model\impl\PostImplModel;
use app\index\service\BaseService;
use app\index\service\PostService;
use think\Log;

class PostImplService extends BaseService implements PostService
{
    protected $model;

    public function __construct()
    {
        Log::info('post实例化');
        $this->model = new PostImplModel();
    }
}