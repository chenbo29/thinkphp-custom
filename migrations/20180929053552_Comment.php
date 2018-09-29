<?php

use Phpmig\Migration\Migration;

class Comment extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "CREATE TABLE `comment` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
        $sql = "DROP TABLE `comment`";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
