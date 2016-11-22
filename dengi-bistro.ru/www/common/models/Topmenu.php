<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "topmenu".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 */
class Topmenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topmenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название пункта меню',
            'alias' => 'УРЛ',
        ];
    }
}
