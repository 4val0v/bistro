<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "footermenu".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $position
 */
class Footermenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'footermenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'position'], 'required'],
            [['position'], 'integer'],
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
            'name' => 'Название',
            'alias' => 'УРЛ',
            'position' => 'Колонка',
        ];
    }
}
