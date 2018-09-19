<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 11:16
 */

namespace app\second\model\impl;



use app\index\model\BaseModel;
use app\index\model\PostModel;

class PostImplModel extends BaseModel implements PostModel
{
    protected $table = 'posts';
    public $perPage = 5;

    public function updateById(array $fields, $id)
    {
        return $this->updateByWhere($fields, array("id" => $id));
    }
}