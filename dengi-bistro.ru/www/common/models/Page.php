<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $h1
 * @property string $alias
 * @property integer $offer_id
 * @property string $text_1
 * @property string $expert_text
 * @property string $text_2
 * @property integer $helpfull
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keys
 * @property string $expert_title
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['h1', 'alias'], 'required'],
            [['offer_id', 'helpfull', 'folder'], 'integer'],
            [['short_desc', 'text_1', 'expert_text', 'text_2', 'seo_desc', 'seo_keys', 'marked'], 'string'],
            [['h1', 'alias', 'seo_title', 'expert_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'h1' => 'H1',
            'alias' => 'УРЛ',
            'folder' => 'Папка',
            'offer_id' => 'Выбор оффера',
            'short_desc' => 'Превью',
            'text_1' => 'Текст 1',
            'marked' => 'Выделенный текст',
            'expert_text' => 'Мнение эксперта',
            'text_2' => 'Текст 2',
            'helpfull' => 'Отображать полезные статьи?',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Desc',
            'seo_keys' => 'Seo Keys',
            'expert_title' => 'Заголовок мнения эксперта',
        ];
    }
    
    public function getPage($alias)
    {
        return self::find()->where(['alias' => $alias])->one();
    }
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id'=>'offer_id']);
    }
    
    public function getFreepage()
    {
        return static::find()->select(['id'])->where(['folder' => ''])->orWhere(['folder'=>null])->all();
    }
    
}
