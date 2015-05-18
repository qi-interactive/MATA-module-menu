<?php
 
/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace mata\modulemenu\models;

use Yii;
use mata\modulemenu\models\Group;
use yii\web\HttpException;

/**
 * This is the model class for table "matamodulemenu_module".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $GroupId
 * @property string $Location
 * @property integer $Enabled
 * @property string $Config
 *
 * @property MatamodulemenuGroup $group
 */
class Module extends \yii\db\ActiveRecord
{
    public static function tableName() {
        return 'matamodulemenu_module';
    }

    public function rules()
    {
        return [
        [['Id','GroupId', 'Location'], 'required'],
        [['GroupId', 'Enabled'], 'integer'],
        [['Config'], 'string'],
        [['Id','Name'], 'string', 'max' => 64],
        [['Location'], 'string', 'max' => 255]
        ];
    }

    public function beforeValidate() {
        if ($this->GroupId == null) {

            $group = new Group();
            $group->Name = $this->Name;

            if ($group->save() == false)
                throw new HttpException(current(current($group->getErrors())));

            $this->GroupId = $group->Id;
        }

        return true;
    }

    public function attributeLabels()
    {
        return [
        'Id' => 'ID',
        'Name' => 'Name',
        'GroupId' => 'Group ID',
        'Location' => 'Location',
        'Enabled' => 'Enabled',
        'Config' => 'Config',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup() {
        return $this->hasOne(MatamodulemenuGroup::className(), ['Id' => 'GroupId']);
    }
}
