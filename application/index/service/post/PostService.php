<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/18
 * Time: 10:10
 */

namespace app\index\service\post;

/**
 * 文章
 * Interface PostService
 * @package app\index\service\post
 */
interface PostService
{
    public function insertWithComment($fields);
}