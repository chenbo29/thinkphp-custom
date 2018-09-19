<?php

namespace app\second\model;


interface PostModel
{
    public function updateById(array $fields, $id);
}
