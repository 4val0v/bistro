<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class CreditForm extends Model
{
    public $sum;
    public $termin;
    public $where;

    public function rules()
    {
        return [
            ['sum', 'required'],
            ['termin', 'integer'],
            ['where', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            //'verifyCode' => 'Verification Code',
        ];
    }

}
