<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 13:25
 */

namespace app\index\service\post\impl;


use app\index\model\impl\CommentImplModel;
use app\index\service\BaseService;
use app\index\service\post\CommentService;
use Pimple\Container;
use think\Log;

/**
 * 文章评论类
 * Class CommentImplService
 * @package app\index\service\post\impl
 */
class CommentImplService extends BaseService implements CommentService
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->model = new CommentImplModel();
    }

    public function test($content){
        Log::info("评论的内容$content");
    }
}