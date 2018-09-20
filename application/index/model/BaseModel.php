<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:25
 */

namespace app\index\model;


use think\Db;
use think\Model;

/**
 * 基础模型类
 * Class BaseModel
 * @package app\index\model
 */
class BaseModel extends Model
{
    protected $table;
    protected $perPage;

    /**
     * 通过id获取表数据记录
     * @param $id 记录id
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getById($id){
        $result = Db::table($this->table)->where('id', $id)->find();
        return $result;
    }

    /**
     * 分页数据
     * @param $page 页码
     * @param null $perPage 每页显示的数据记录
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function listWithPaginate($page, $perPage = null){
        $result = Db::table($this->table)->page($page, $perPage)->select();
        return $result;
    }

    /**
     * 插入数据
     * @param $fields 数据字段
     * @return int|string
     */
    public function insertWithFields($fields){
        $createAt = date('Y-m-d H:i:s', time());
        $updateAt = date('Y-m-d H:i:s', time());
        $fields = array_merge($fields, ['created_at' => $createAt, 'updated_at' => $updateAt]);
        return Db::table($this->table)->insertGetId($fields);
    }

    /**
     * @param $fields
     * @param $where 条件
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function updateByWhere($fields, $where){
        // fixme
        $updateAt = date('Y-m-d H:i:s', time());
        $fields = array_merge($fields, ['updated_at' => $updateAt]);
        $table = Db::table($this->table);
        foreach ($where as $key => $value){
            $table->where($key, $value);
        }
        return $table->update($fields);
    }

    /**
     * 删除数据
     * @param $id
     * @return int
     */
    public function deleteById($id){
        return $this->where('id', '=', $id)->delete();
    }

    /**
     * 通过id判断记录数据是否存在
     * @param $id
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function checkExistsById($id){
        return Db::table($this->table)->where('id', $id)->find() ? true : false;
    }
}