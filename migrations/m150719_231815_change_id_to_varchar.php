<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150719_231815_change_id_to_varchar extends Migration
{
	public function safeUp()
	{
		$this->dropPrimaryKey('PRIMARY', '{{%matamodulemenu_module}}');
		$this->alterColumn('{{%matamodulemenu_module}}', 'Id', Schema::TYPE_STRING . '(64) NOT NULL PRIMARY KEY');
	}

	public function safeDown()
	{
		$this->dropPrimaryKey('PRIMARY', '{{%matamodulemenu_module}}');
		$this->alterColumn('{{%matamodulemenu_module}}', 'Id', Schema::TYPE_PK);
	}
}
