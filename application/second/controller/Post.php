<?php
namespace app\second\controller;

use app\second\BaseController;
use app\second\ResponseCode;
use app\second\service\post\impl\CommentImplService;
use app\second\service\post\impl\PostImplService;
use think\Request;

class Post extends BaseController
{
    protected $request;
    protected $postService;
    protected $commentService;

    public function __construct(Request $request = null, PostImplService $postService = null, CommentImplService $commentService = null)
    {
        $this->request = $request;
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function index()
    {
        $page = Request::instance()->get('page', 1);
        $result = $this->postService->listWithPaginate($page);
        $this->commentService->test('测试两个service2');
        return response(ResponseCode::statusSuccess, '', $result);
    }

//    public function create(){
//
//    }

    /**
     * 保存
     * @return array
     */
    public function save(){
        $title = $this->request->post('title','','htmlspecialchars');
        $content = $this->request->post('content','','htmlspecialchars');
        if ($postId = $this->postService->insert(['title' => $title, 'content' => $content])){
            return response(ResponseCode::statusSuccess, '保存成功', (int)$postId);
        } else {
            return response(ResponseCode::statusError, '保存失败');
        }
    }

    /**
     * 获取
     * @param $id
     * @return array
     */
    public function read($id){
        if ($post = $this->postService->getById($id)){
            return response(ResponseCode::statusSuccess, '', $post);
        } else {
            return response(ResponseCode::statusError, '不存在');
        }
    }

//    public function edit(){
//
//    }

    /**
     * 编辑保存
     * @param $id
     * @return array
     */
    public function update($id){
        if (!$this->postService->getById($id)){
            return response(ResponseCode::statusError, '不存在该记录数据');
        }
        $title = Request::instance()->post('title','','htmlspecialchars');
        $content = Request::instance()->post('content','','htmlspecialchars');
        if ($postId = $this->postService->updateById(['title' => $title, 'content' => $content], $id)){
            return response(ResponseCode::statusSuccess, '编辑保存成功');
        } else {
            return response(ResponseCode::statusError, '编辑保存失败或无数据更新');
        }
    }

    /**
     * 删除
     * @param $id
     * @return array|\think\Response
     */
    public function delete($id){
        if (!$this->postService->checkExistsById($id)){
            return response(ResponseCode::statusSuccess, '不存在');
        }
        if ($this->postService->deleteById($id)){
            return response(ResponseCode::statusSuccess, '删除成功');
        } else {
            return response(ResponseCode::statusError, '删除失败');
        }
    }
}