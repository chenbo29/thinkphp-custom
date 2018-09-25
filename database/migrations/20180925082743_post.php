<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Post extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    public function up()
    {
        $sql = "CREATE TABLE `posts` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `create_time` int(10) NOT NULL,
 `update_time` int(10) NOT NULL,
 PRIMARY KEY (`id`)
)";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE `posts`";
        $this->execute($sql);
    }
}
