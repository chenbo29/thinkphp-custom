<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:10
 */

namespace app\index\service\post;


interface PostService
{
    public function getById($id);

    public function listWithPaginate($page, $perPage);

    public function insert($fields);

    public function updateById($fields, $id);

    public function deleteById($id);

    public function checkExistsById($id);
}