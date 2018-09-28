<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/28
 * Time: 10:54
 */

namespace app\index\model\impl;


use app\index\model\BaseModel;
use app\index\model\CommentModel;

class CommentImplModel extends BaseModel implements CommentModel
{
    protected $table = 'comment';
    protected $autoWriteTimestamp = true;
}