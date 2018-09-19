<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:13
 */

namespace app\second\service\post\impl;



use app\index\service\BaseService;
use app\index\service\post\PostService;
use think\Log;

class PostImplService extends BaseService implements PostService
{
    public function __construct()
    {
        Log::info('post被实例化');
    }
    /**
     * 通过id获取某条记录数据
     * @param int $id
     * @return mixed
     */
    public function getById($id){
        return $this->getPostModel()->getById($id);
    }

    /**
     * 分页数据
     * @param $page
     * @param null $perPage
     * @return mixed
     */
    public function listWithPaginate($page, $perPage = null)
    {
        $perPage = $perPage ? $perPage : $this->getPostModel()->perPage;
        return $this->getPostModel()->listWithPaginate($page, $perPage);
    }

    /**
     * 新增数据
     * @param array $fields
     * @return mixed
     */
    public function insert(array $fields)
    {
        return $this->getPostModel()->insert($fields);
    }

    /**
     * 通过id更新数据
     * @param array $fields
     * @param $id
     * @return mixed
     */
    public function updateById(array $fields, $id)
    {
        return $this->getPostModel()->updateById($fields, $id);
    }

    /**
     * 通过id删除数据
     * @param int $id
     * @return mixed
     */
    public function deleteById($id){
        return $this->getPostModel()->deleteById($id);
    }

    /**
     * 通过id判断是否存在
     * @param int $id
     * @return mixed
     */
    public function checkExistsById($id){
        return $this->getPostModel()->checkExistsById($id);
    }

    /**
     * 获取模型
     * @return mixed
     */
    public function getModel(){
        return $this->getPostModel();
    }

    public function getPostModel(){
        return $this->createModel('PostModel');
    }
}