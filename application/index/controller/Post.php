<?php
namespace app\index\controller;

use app\index\BaseController;
use app\index\ResponseCode;
use think\Request;

/**
 * 接口请求处理控制类（文章）
 * Class Post
 * @package app\index\controller
 */
class Post extends BaseController
{
    /**
     * 分页列表数据
     * @return array|\think\Response
     */
    public function index()
    {
        $page = Request::instance()->get('page', 1);
        $result = $this->getPostService()->listWithPaginate($page);
        return response(ResponseCode::statusSuccess, '', $result);
    }

    /**
     * 保存
     * 控制层
     * 获取参数
     * 参数格式验证
     *
     * @return array
     */
    public function save(){
        // 对Request请求数据进行控制处理-默认值-过滤
        $title = Request::instance()->post('title','','htmlspecialchars');
        $content = Request::instance()->post('content','','htmlspecialchars');
        // 业务数据
        $fields = [
            'title' => $title . date('Y-m-d H:i:s'),
            'content' => $content . date('Y-m-d H:i:s')
        ];
        // 对业务的数据进行控制处理-验证字段值是否符合条件
        $PostValidateResult = validateCheck('PostValidate', $fields, 'save');
        if ($PostValidateResult !== true){
            return response(ResponseCode::statusError, $PostValidateResult);
        }
        // 对业务处理结果进行控制处理-Response结果返回
        if ($postId = $this->getPostService()->insertWithComment($fields)){
//        if ($postId = $this->getPostService()->insert($fields)){
            return response(ResponseCode::statusSuccess, '保存成功', ['id' => $postId]);
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
        if ($post = $this->getPostService()->getById($id)){
            return response(ResponseCode::statusSuccess, '', $post);
        } else {
            return response(ResponseCode::statusError, '不存在');
        }
    }

    /**
     * 编辑保存
     * @param $id
     * @return array
     */
    public function update($id){
        if (!$this->getPostService()->checkExistsById($id)){
            return response(ResponseCode::statusError, '不存在该记录数据');
        }
        $title = Request::instance()->put('title','','htmlspecialchars');
        $content = Request::instance()->put('content','','htmlspecialchars');
        if ($postId = $this->getPostService()->updateById(['title' => $title, 'content' => $content], $id)){
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
        if (!$this->getPostService()->checkExistsById($id)){
            return response(ResponseCode::statusSuccess, '不存在该记录数据');
        }
        if ($this->getPostService()->deleteById($id)){
            return response(ResponseCode::statusSuccess, '删除成功');
        } else {
            return response(ResponseCode::statusError, '删除失败');
        }
    }

    /**
     * 获取文章对象
     * @return mixed
     */
    private function getPostService(){
        return $this->kernel->createService('post:PostService');
    }
}