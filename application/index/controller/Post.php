<?php
namespace app\index\controller;

use app\index\BaseController;
use app\index\service\impl\PostImplService;
use app\index\responseCode;
use think\Request;

class Post extends BaseController
{
    public function index()
    {
        $page = Request::instance()->get('page', 1);
        $result = $this->getPostService()->listWithPaginate($page);
        return response(responseCode::statusSuccess, '', $result);
    }

//    public function create(){
//
//    }

    /**
     * 保存
     * @return array
     */
    public function save(){
        $title = Request::instance()->post('title','','htmlspecialchars');
        $content = Request::instance()->post('content','','htmlspecialchars');

        $postModel = $this->getPostService()->getModel();
        $postModel->title = "标题是$title";
        $postModel->content = "正文内容是$content";
        $postModel->save();

        if ($postId = $this->getPostService()->insert(['title' => $title, 'content' => $content])){
            return response(responseCode::statusSuccess, '保存成功', (int)$postId);
        } else {
            return response(responseCode::statusError, '保存失败');
        }
    }

    /**
     * 获取
     * @param $id
     * @return array
     */
    public function read($id){
        if ($post = $this->getPostService()->getById($id)){
            return response(responseCode::statusSuccess, '', $post);
        } else {
            return response(responseCode::statusError, '不存在');
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
        $title = Request::instance()->post('title','','htmlspecialchars');
        $content = Request::instance()->post('content','','htmlspecialchars');
        if ($postId = $this->getPostService()->updateById(['title' => $title, 'content' => $content], $id)){
            return response(responseCode::statusSuccess, '编辑保存成功');
        } else {
            return response(responseCode::statusError, '编辑保存失败或无数据更新');
        }
    }

    /**
     * 删除
     * @param $id
     * @return array|\think\Response
     */
    public function delete($id){
        if (!$this->getPostService()->checkExistsById($id)){
            return response(responseCode::statusSuccess, '不存在');
        }
        if ($this->getPostService()->deleteById($id)){
            return response(responseCode::statusSuccess, '删除成功');
        } else {
            return response(responseCode::statusError, '删除失败');
        }
    }

    private function getPostService(){
        return $this->createService('post:PostService');
    }
}