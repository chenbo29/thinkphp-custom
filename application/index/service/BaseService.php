<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 9:46
 */

namespace app\index\service;

use Pimple\Container;

/**
 * 基础service类
 * Class BaseService
 * @package app\index\service
 */
class BaseService
{
    protected $container;
    protected $redis;
    protected $kernel;
    protected $model;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->redis = $container['redis'];
        $this->kernel = $container['kernel'];
    }

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
    public function insert($fields)
    {
        return $this->model->insertWithFields($fields);
    }

    /**
     * 通过id更新数据
     * @param array $fields
     * @param $id
     * @return mixed
     */
    public function updateById($fields, $id)
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
     * 通过where判断是否存在
     * @param int $id
     * @return mixed
     */
    public function checkExistsByWhere($where){
        return $this->model->checkExistsByWhere($where);
    }
}