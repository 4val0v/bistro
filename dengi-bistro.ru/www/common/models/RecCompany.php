<?php

namespace common\models;
use frontend\models\Company;
use Yii;

/**
 * This is the model class for table "rec_company".
 *
 * @property integer $id
 * @property integer $company1
 * @property integer $company2
 * @property integer $company3
 */
class RecCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rec_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company1', 'company2', 'company3'], 'required'],
            [['company1', 'company2', 'company3'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company1' => 'Первая компания',
            'company2' => 'Вторая компания',
            'company3' => 'Третья компания',
        ];
    }
    
    public function getCompany()
    {
        $ids = static::find()->one();
        
        return Company::find()->select(['id', 'name', 'alias', 'img', 'max_sum', 'max_termin', 'stars', 'checked', 'href', 'lit_desc'])->where(['id' => $ids])->all();
    }
}
