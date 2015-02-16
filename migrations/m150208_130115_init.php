<?php

/*
 * This file is part of the mata project.
 *
 * (c) mata project <http://github.com/mata/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m150208_130115_init extends Migration
{
	public function up()
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

	public function down()
	{
		$this->dropTable('{{%matamodulemenu_module}}');
		$this->dropTable('{{%matamodulemenu_group}}');

	}
}