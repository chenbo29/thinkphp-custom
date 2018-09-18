<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 11:16
 */

namespace app\index\model\impl;



use app\index\model\BaseModel;
use app\index\model\PostModel;

class PostImplModel extends BaseModel implements PostModel
{
    protected $table = 'posts';
    protected $perPage = 5;

    public function updateById(array $fields, int $id)
    {
        return $this->update($fields, array("id" => $id));
    }
}