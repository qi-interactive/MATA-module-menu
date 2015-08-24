<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150821_150000_remove_mata_modules extends Migration
{
	public function safeUp()
	{
        $this->delete('{{%matamodulemenu_module}}', 'Location LIKE "mata\\\\\\\\%"');
	}
}
