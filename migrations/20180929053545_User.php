<?php

use Phpmig\Migration\Migration;

class User extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "CREATE TABLE `user`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(8) NOT NULL,
    `password` VARCHAR(60) NOT NULL,
    `create_time` int(10) not NULL,
    `update_time` int(10) not NULL,
    PRIMARY KEY(`id`)
)";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE `user`";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
