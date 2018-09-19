<?php

namespace app\index\model;


interface PostModel
{
    public function updateById(array $fields, $id);
}
