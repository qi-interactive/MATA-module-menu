<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150208_130115_init extends Migration
{
	public function safeUp()
	{
		$this->createTable('{{%matamodulemenu_group}}', [
			'Id'                   => Schema::TYPE_PK,
			'Name'             => Schema::TYPE_STRING . '(128) NOT NULL',
			'Order'                => Schema::TYPE_SMALLINT . '(2) NOT NULL',
			]);

		$this->createTable('{{%matamodulemenu_module}}', [
			'Id'        => Schema::TYPE_PK,
			'Name'           => Schema::TYPE_STRING . '(64)',
			'GroupId'   => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'Location'             => Schema::TYPE_STRING . '(255) NOT NULL',
			'Enabled' 	=> Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
			'Config' => Schema::TYPE_TEXT,
			]);

		$this->addForeignKey('fk_matamodulemenugroup_matamodulemenumodule', '{{%matamodulemenu_module}}', 'GroupId', '{{%matamodulemenu_group}}', 'Id', 'CASCADE', 'RESTRICT');
	}

	public function safeDown()
	{
		$this->dropTable('{{%matamodulemenu_module}}');
		$this->dropTable('{{%matamodulemenu_group}}');

	}
}