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
use Pimple\Container;
use think\Exception;
use think\Log;

/**
 * 文章类
 * Class PostImplService
 * @package app\index\service\post\impl
 */

class PostImplService extends BaseService implements PostService
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->model = new PostImplModel();
    }

    /**
     * 业务处理逻辑
     * 新增数据并制造评论数据
     * @param array $fields
     * @return mixed
     */
    public function insertWithComment($fields)
    {
        // 业务逻辑1：插入用户提交的文章数据
        $postId = $this->model->insertWithFields($fields);
        if ($postId) {
            // 业务逻辑2：文章增加成功则默认新增一条评论数据
            try {
                // 捕获异常，避免影响数据返回
                $commentFields = [
                    'content' => sprintf("%s<<{$fields['title']}>>%s", '这篇文章', '写的真不错')
                ];
                $this->getCommentService()->insert($commentFields);

                // 其他：业务逻辑3等

            } catch (Exception $e){
                // 捕获后日志记录，或其它处理
                Log::error($e->getMessage());
            }
        }
        // 返回业务逻辑处理结果
        return $postId;
    }

    public function getCommentService(){
        return $this->kernel->createService('post:CommentService');
    }
}