<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150417_162544_add_order_field extends Migration
{
    
    public function safeUp()
    {
        $this->addColumn('{{%matamodulemenu_module}}', 'Order', 'INT(11)');
    }

}
