<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $h1
 * @property string $title
 * @property string $seo_desc
 * @property string $seo_keys
 * @property string $desc
 * @property string $lit_desc
 * @property string $vk_group
 * @property string $fb_group
 * @property integer $max_sum
 * @property integer $old
 * @property string $pay
 * @property string $watch
 * @property integer $stars
 * @property integer $raiting
 * @property string $href
 * @property integer $checked
 * @property string $last_upd
 *
 * @property Review[] $reviews
 * @property Wall[] $walls
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'h1', 'title'], 'required'],
            [['desc'], 'string'],
            [['max_sum', 'max_termin', 'old', 'stars', 'raiting', 'checked'], 'integer'],
            ['pay', 'safe'],
            [['name', 'alias', 'h1', 'title', 'seo_desc', 'seo_keys', 'img', 'lit_desc', 'vk_group', 'fb_group', 'watch', 'href', 'last_upd'], 'string', 'max' => 255],
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
            'h1' => 'H1',
            'title' => 'Seo Title',
            'seo_desc' => 'Seo Description',
            'seo_keys' => 'Seo Keywords',
            'desc' => 'О компании',
            'img'=>'Логотип компании',
            'lit_desc' => 'Меседж',
            'vk_group' => 'Группа в Vk',
            'fb_group' => 'Группа в Fb',
            'max_sum' => 'Максимальная сумма кредита',
            'max_termin' => 'Максимальный срок кредита (в днях)',
            'old'=>'Возраст заемщика',
            'pay' => 'Способы выплат',
            'watch' => 'Время рассмотрения',
            'stars' => 'Звезд',
            'raiting' => 'Рейтинг',
            'href' => 'Ссылка',
            'checked' => 'Проверенна',
            'last_upd' => 'Обновление',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWalls()
    {
        return $this->hasMany(Wall::className(), ['company_id' => 'id']);
    }
}
