<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace mata\modulemenu\models;

use Yii;

/**
 * This is the model class for table "matamodulemenu_group".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $Order
 *
 * @property MatamodulemenuModule[] $matamodulemenuModules
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matamodulemenu_group';
    }

    public function rules()
    {
        return [
        [['Name', 'Order'], 'required'],
        [['Order'], 'integer'],
        [['Name'], 'string', 'max' => 128]
        ];
    }

    public function beforeValidate() {

        if ($this->Order == null) {

            $maxOrder = self::find()
            ->select('max(`Order`)')
            ->scalar();

            $this->Order = $maxOrder == null ? 1 : $maxOrder + 1;
        }

        return parent::beforeValidate();
    }

    public function attributeLabels()
    {
        return [
        'Id' => 'ID',
        'Name' => 'Name',
        'Order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatamodulemenuModules()
    {
        return $this->hasMany(MatamodulemenuModule::className(), ['GroupId' => 'Id']);
    }
}
