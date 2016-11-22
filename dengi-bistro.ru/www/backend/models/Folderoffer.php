<?php

namespace backend\models;

use Yii;
use common\models\Offer;
/**
 * This is the model class for table "folderoffer".
 *
 * @property integer $id
 * @property string $name
 * @property string $ids
 */
class Folderoffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folderoffer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['ids'], 'safe'],
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
            'ids' => 'Офферы',
        ];
    }
    
    public function getAll()
    {
        return static::find()->all();
    }
    
    /*public function getIds($id)
    {
        $ids = static::find()->select(['ids'])->where(['id' => $id])->one()->ids;
        $ids = explode(",", $ids);
        return $ids;
    }*/
    
    public function getIds($id)
    {
        $pages= Offer::find()->where(['folder'=>$id])->all();
        $ids=[];
        foreach ($pages as $page)
        {
            $ids[$page->id]=$page->id;
        }
        return $ids;
    }
    public function getFolderName($id)
    {
        return static::find()->select(['name'])->where(['id' => $id])->one()->name;
    }
}
