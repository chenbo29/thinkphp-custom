<?php

use Phpmig\Migration\Migration;

class Post extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "CREATE TABLE `post` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `create_time` int(10) NOT NULL,
 `update_time` int(10) NOT NULL,
 PRIMARY KEY (`id`)
)";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE `post_test`";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
