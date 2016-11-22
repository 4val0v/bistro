<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class LoadFile extends Model
{
    public $file;
    
    public function rules()
    {
        return [
            ['file', 'file'],
        ];
    }    
}