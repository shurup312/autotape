<?php
use yii\db\Schema;
use yii\db\Migration;

class m150807_140327_meta_tags extends Migration
{

	public $tableName = '{{%meta_tags}}';

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName==='mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable(
			$this->tableName, [
			'id'           => $this->primaryKey(),
			'link'         => $this->string()
								   ->notNull(),
			'title'        => $this->string()
								   ->notNull(),
			'description'  => $this->string()
								   ->notNull(),
			'keywords'     => $this->string()
								   ->notNull(),
			'date_created' => $this->timestamp(),
			'date_deleted' => $this->timestamp(),
		], $tableOptions
		);
		$this->execute("ALTER TABLE `meta_tags`
			CHANGE COLUMN `date_deleted` `date_deleted` TIMESTAMP NULL DEFAULT NULL AFTER `date_created`;");

	}

	public function down()
	{
		$this->dropTable($this->tableName);
	}
}
