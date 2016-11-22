<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property string $name
 * @property string $ids
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','ids'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['ids'], 'safe'],
            ['folder', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название оффера',
            'folder' => 'Папка',
            'ids' => 'УРЛы компаний',
        ];
    }
    public function getFreepage()
    {
        return static::find()->select(['id'])->where(['folder' => ''])->orWhere(['folder'=>null])->all();
    }
}
