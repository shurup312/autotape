<?php
use yii\db\Schema;
use yii\db\Migration;

class m150807_093045_addTable_works extends Migration
{

	public $tableName = '{{%works}}';

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName==='mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable(
			$this->tableName, [
			'id'           => $this->primaryKey(),
			'user_id'  => $this->integer(),
			'name'         => $this->string()
								   ->notNull(),
			'image1'       => $this->integer()

								   ->notNull(),
			'image2'       => $this->integer(),
			'description'  => $this->text(),
			'date_created' => $this->timestamp(),
			'date_deleted' => $this->timestamp(),
		], $tableOptions
		);

	}

	public function down()
	{
		$this->dropTable($this->tableName);
	}
}
