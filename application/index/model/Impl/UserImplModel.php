<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/25
 * Time: 11:40
 */

namespace app\index\model\impl;


use app\index\model\BaseModel;

class UserImplModel extends BaseModel
{
    protected $table = 'user';
    protected $autoWriteTimestamp = true;
}