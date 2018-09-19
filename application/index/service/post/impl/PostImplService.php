<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:13
 */

namespace app\index\service\post\impl;



use app\index\model\impl\PostImplModel;
use app\index\service\BaseService;
use app\index\service\post\PostService;
use think\Log;

class PostImplService extends BaseService implements PostService
{
    protected $model;

    public function __construct()
    {
        $this->model = new PostImplModel();
    }
}