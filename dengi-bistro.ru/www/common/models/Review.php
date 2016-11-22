<?php

namespace common\models;

use Yii;
use frontend\models\Company;
/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property integer $company_id
 * @property integer $stars
 * @property string $date
 * @property integer $raiting
 * @property integer $likes
 * @property string $user_ids_like
 * @property string $user_ids_dislike
 * @property integer $ball
 *
 * @property User $user
 * @property Company $company
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public $color;
    public $strip;
    public function afterFind()
    {
        $arr=[1=>"#f7dcdc",2=>"#f7e9dc",3=>"#f7f7dc",4=>"#ecf7dc",5=>"#dcf7de"];
        $this->color=$arr[$this->stars];
        
        if($this->ball >= 10 && $this->ball<20)
            $this->strip = "#EB4825";
        else if($this->ball >= 20 && $this->ball < 30)
            $this->strip = "#EF6D21";
        else if($this->ball >= 30 && $this->ball < 40)
            $this->strip = "#F29923";
        else if($this->ball >= 40 && $this->ball < 60)
            $this->strip = "#F3CD2E";
        else if($this->ball >= 60 && $this->ball < 80)
            $this->strip = "#EEE736";
        else if($this->ball >= 80 && $this->ball < 90)
            $this->strip = "#8DC142";
        else if($this->ball >= 90 && $this->ball <= 100)
            $this->strip = "#4CB767";
        //$this->date=date("d:m:Y",$this->date);
    }
    public function rules()
    {
        return [
            [['text', 'user_id', 'company_id', 'stars', 'date', 'likes'], 'required'],
            [['text', 'user_ids_like', 'user_ids_dislike'], 'string'],
            [['user_id', 'company_id', 'stars', 'raiting', 'likes', 'ball'], 'integer'],
            [['date'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'user_id' => 'Пользователь',
            'company_id' => 'Компания',
            'stars' => 'Звезд',
            'date' => 'Дата',
            'raiting' => 'Рейтинг',
            'likes' => 'Лайков',
            'user_ids_like' => 'User Ids Like',
            'user_ids_dislike' => 'User Ids Dislike',
            'ball' => 'Балл',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
