<?php
use yii\db\Schema;
use yii\db\Migration;

class m150807_100523_alterTable_works extends Migration
{

	public function up()
	{
		$this->execute(
			"ALTER TABLE `works`
        	CHANGE COLUMN `image1` `image1` INT NOT NULL COLLATE 'utf8_unicode_ci' AFTER `name`,
        	CHANGE COLUMN `image2` `image2` INT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci' AFTER `image1`,
        	ADD CONSTRAINT `FK_works_images` FOREIGN KEY (`image1`) REFERENCES `images` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
        	ADD CONSTRAINT `FK_works_images_2` FOREIGN KEY (`image2`) REFERENCES `images` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
		$this->execute("ALTER TABLE `works`
			CHANGE COLUMN `image2` `image2` INT(11) NULL COMMENT 'Второе изображение работы' AFTER `image1`;");
		$this->execute("ALTER TABLE `works`
			CHANGE COLUMN `date_deleted` `date_deleted` TIMESTAMP NULL DEFAULT NULL AFTER `date_created`;");
		$this->execute("ALTER TABLE `images`
			CHANGE COLUMN `date_deleted` `date_deleted` TIMESTAMP NULL DEFAULT NULL AFTER `date_created`;");
    }

	public function down()
	{
		$this->execute(
					"ALTER TABLE `works`
						CHANGE COLUMN `image1` `image1` VARCHAR(32) NOT NULL AFTER `name`,
						CHANGE COLUMN `image2` `image2` VARCHAR(32) NULL DEFAULT NULL AFTER `image1`,
						DROP INDEX `FK_works_images`,
						DROP INDEX `FK_works_images_2`,
						DROP FOREIGN KEY `FK_works_images`,
						DROP FOREIGN KEY `FK_works_images_2`;");
		$this->execute("ALTER TABLE `works`
			CHANGE COLUMN `date_deleted` `date_deleted` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' AFTER `date_created`;");
		$this->execute("ALTER TABLE `images`
			CHANGE COLUMN `date_deleted` `date_deleted` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00' AFTER `date_created`;");
	}
}
