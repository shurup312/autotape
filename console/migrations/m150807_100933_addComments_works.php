<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_100933_addComments_works extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `works`
        	CHANGE COLUMN `name` `name` VARCHAR(255) NOT NULL COMMENT 'Имя работы' COLLATE 'utf8_unicode_ci' AFTER `user_id`");
        $this->execute("ALTER TABLE `works`
        	CHANGE COLUMN `image1` `image1` INT(11) NOT NULL COMMENT 'Первое изображение работы' AFTER `name`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `image2` `image2` INT(11) NULL COMMENT 'Второе изображение работы' AFTER `image1`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `description` `description` TEXT NOT NULL COMMENT 'Описание работы' AFTER `image2`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `user_id` `user_id` INT(11) NOT NULL COMMENT 'Пользователь, добавивший работу' AFTER `id`;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE `works`
        	CHANGE COLUMN `name` `name` VARCHAR(255) NOT NULL COMMENT '' COLLATE 'utf8_unicode_ci' AFTER `user_id`");
        $this->execute("ALTER TABLE `works`
        	CHANGE COLUMN `image1` `image1` INT(11) NOT NULL COMMENT '' AFTER `name`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `image2` `image2` INT(11) NULL COMMENT '' AFTER `image1`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `description` `description` TEXT NOT NULL COMMENT '' AFTER `image2`;");
        $this->execute("ALTER TABLE `works`
                	CHANGE COLUMN `user_id` `user_id` INT(11) NOT NULL COMMENT '' AFTER `id`;");
    }
}
