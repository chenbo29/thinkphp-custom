<?php

namespace app\index\model;

/**
 * 文章模型类
 * Interface PostModel
 * @package app\index\model
 */
interface PostModel
{
    public function updateById(array $fields, $id);
}
