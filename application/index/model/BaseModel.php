<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:25
 */

namespace app\index\model;


use think\Db;

class BaseModel
{
    protected $table;
    protected $perPage;

    public function getById(int $id){
        $result = Db::table($this->table)->where('id', $id)->get();
        return $result;
    }

    public function listWithPaginate(){
        $result = Db::table($this->table)->simplePaginate($this->perPage);
        return $result;
    }

    public function insert(array $fields){
        return Db::table($this->table)->insertGetId($fields);
    }

    public function update(array $fields, array $where){
        $table = Db::table($this->table);
        foreach ($where as $key => $value){
            $table->where($key, $value);
        }
        return $table->update($fields);
    }

    public function delete(int $id){
        return Db::table($this->table)->delete($id);
    }

    public function checkExistsById(int $id){
        return Db::table($this->table)->where('id', $id)->exists();
    }
}