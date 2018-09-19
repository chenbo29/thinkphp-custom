<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:25
 */

namespace app\second\model;


use think\Db;
use think\Model;

class BaseModel extends Model
{
    protected $table;
    protected $perPage;

    public function getById(int $id){
        $result = Db::table($this->table)->where('id', $id)->find();
        return $result;
    }

    public function listWithPaginate($page, $perPage = null){
        $result = Db::table($this->table)->page($page, $perPage)->select();
        return $result;
    }

    public function insert(array $fields){
        $createAt = date('Y-m-d H:i:s', time());
        $updateAt = date('Y-m-d H:i:s', time());
        $fields = array_merge($fields, ['created_at' => $createAt, 'updated_at' => $updateAt]);
        return Db::table($this->table)->insertGetId($fields);
    }

    public function updateByWhere(array $fields, array $where){
        $updateAt = date('Y-m-d H:i:s', time());
        $fields = array_merge($fields, ['updated_at' => $updateAt]);
        $table = Db::table($this->table);
        foreach ($where as $key => $value){
            $table->where($key, $value);
        }
        return $table->update($fields);
    }

    public function deleteById($id){
        return $this->where('id', '=', $id)->delete();
    }

    public function checkExistsById($id){
        return Db::table($this->table)->where('id', $id)->find() ? true : false;
    }
}