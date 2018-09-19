<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 9:46
 */

namespace app\index\service;



use app\index\service\impl\PostImplService;
use app\index\ServiceKernel;

class BaseService
{
    protected $model;

    /**
     * 通过id获取某条记录数据
     * @param int $id
     * @return mixed
     */
    public function getById($id){
        return $this->model->getById($id);
    }

    /**
     * 分页数据
     * @param $page
     * @param null $perPage
     * @return mixed
     */
    public function listWithPaginate($page, $perPage = null)
    {
        $perPage = $perPage ? $perPage : $this->model->perPage;
        return $this->model->listWithPaginate($page, $perPage);
    }

    /**
     * 新增数据
     * @param array $fields
     * @return mixed
     */
    public function insert(array $fields)
    {
        return $this->model->insert($fields);
    }

    /**
     * 通过id更新数据
     * @param array $fields
     * @param $id
     * @return mixed
     */
    public function updateById(array $fields, $id)
    {
        return $this->model->updateById($fields, $id);
    }

    /**
     * 通过id删除数据
     * @param int $id
     * @return mixed
     */
    public function deleteById($id){
        return $this->model->deleteById($id);
    }

    /**
     * 通过id判断是否存在
     * @param int $id
     * @return mixed
     */
    public function checkExistsById($id){
        return $this->model->checkExistsById($id);
    }

    /**
     * 获取模型
     * @return mixed
     */
    public function getModel(){
        return $this->model;
    }
}