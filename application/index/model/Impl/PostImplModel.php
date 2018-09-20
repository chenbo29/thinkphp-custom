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

/**
 * 文章模型类
 * Class PostImplModel
 * @package app\index\model\impl
 */
class PostImplModel extends BaseModel implements PostModel
{
    protected $table = 'posts';
    public $perPage = 5;

    /**
     * 通过id更新post数据
     * @param array $fields
     * @param $id
     * @return int|string
     */
    public function updateById(array $fields, $id)
    {
        return $this->save($fields, function ($query) use($id) {
            $query->where('id', '=', $id);
        });
    }
}