<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_102317_addComments_images extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE `images`
        	CHANGE COLUMN `path` `path` VARCHAR(255) NOT NULL COMMENT 'Путь до изображения' COLLATE 'utf8_unicode_ci' AFTER `user_id`;");
        $this->execute("ALTER TABLE `images`
        	CHANGE COLUMN `user_id` `user_id` INT(11) NULL DEFAULT NULL COMMENT 'ID пользователя, загрузившего изображение' AFTER `id`,
        	CHANGE COLUMN `filename` `filename` VARCHAR(255) NOT NULL COMMENT 'Имя файла' COLLATE 'utf8_unicode_ci' AFTER `path`;");
    }

    public function down()
    {
        $this->execute("ALTER TABLE `images`
        	CHANGE COLUMN `path` `path` VARCHAR(255) NOT NULL COMMENT '' COLLATE 'utf8_unicode_ci' AFTER `user_id`;");
        $this->execute("ALTER TABLE `images`
        	CHANGE COLUMN `user_id` `user_id` INT(11) NULL DEFAULT NULL COMMENT '' AFTER `id`,
        	CHANGE COLUMN `filename` `filename` VARCHAR(255) NOT NULL COMMENT '' COLLATE 'utf8_unicode_ci' AFTER `path`;");
    }
}
