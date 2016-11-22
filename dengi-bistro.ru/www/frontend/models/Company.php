<?php

namespace frontend\models;
use common\models\Review;
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
    public $age;
    public $termin;
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
    
    public function afterFind()
    {
        if($this->old==1) $this->age='18 лет';
        else if($this->old==2) $this->age='20 лет'; 
        else if($this->old==3) $this->age='21 года';
        
        if($this->max_termin<=30) {$this->termin=$this->max_termin." дней";}
        else if($this->max_termin>30 && $this->max_termin<=180) {$this->termin=round($this->max_termin/30, 1)." месяца";}
        else if($this->max_termin>180) {$this->termin=round($this->max_termin/365, 2)." лет";}
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
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
    public function getCompany($alias)
    {
        return Company::find()->where(['alias'=>$alias])->one();
    }
    public function getCompanies($sum=false, $termin=false, $pay=false)
    {
        if(!$sum) {$sum=50000;} 
        $query=static::find()->where(['>=', 'max_sum', $sum])->andWhere(['!=', 'href', '']);
        if($termin)
        {
            $query=$query->andWhere(['>=', 'max_termin', $termin]);
        }
        if($pay)
        {
            $query=$query->andWhere(['like', 'pay', $pay]);
        }
        $query=$query->all();
        $ids=$this->getIds($query);
        return [$query, $ids];
    }
    public function getIds($companies)
    {
        $str="";
        foreach($companies as $comp)
        {
            $str.=$comp->id.',';
        }
        return $str;
    }

    public function getCompaniesSort($ids, $sortby, $sort, $pay, $old)
    {
        $query=static::find()->where(['id'=>array_filter(explode(',', $ids))]);
        if($old)
            $query=$query->andWhere(['<=', 'old', $old]);
            
        if($pay)
        {
            $pays=explode("-", $pay);
            $str="";
            for($i=0; $i<count($pays)-1; $i++)
            $str.="`pay` like '%$pays[$i]%' OR ";
            $str=substr($str, 0, -4);
            $query=$query->andFilterWhere(['or', 
                $str
            ]);
        }

        if($sortby)
            $query=$query->orderBy($sortby.' '.$sort);
        return $query->all();
    }
    public function getCompaniesSortAll($sortby, $sort, $pay, $old)
    {
        $query=static::find();
        if($old)
            $query=$query->andWhere(['<=', 'old', $old]);
            
        if($pay)
        {
            $pays=explode("-", $pay);
            $str="";
            for($i=0; $i<count($pays)-1; $i++)
            $str.="`pay` like '%$pays[$i]%' OR ";
            $str=substr($str, 0, -4);
            $query=$query->andFilterWhere(['or', 
                $str
            ]);
        }

        if($sortby)
            $query=$query->orderBy($sortby.' '.$sort);
        return $query->all();
    }
}
