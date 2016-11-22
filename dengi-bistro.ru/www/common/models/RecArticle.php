<?php

namespace common\models;
use common\models\Page;
use Yii;

/**
 * This is the model class for table "rec_article".
 *
 * @property integer $id
 * @property integer $article1
 * @property string $img1
 * @property integer $article2
 * @property string $img2
 * @property integer $article3
 * @property string $img3
 */
class RecArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rec_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article1', 'article2', 'article3',], 'required'],
            [['article1', 'article2', 'article3'], 'integer'],
            [['img1', 'img2', 'img3'], 'file','skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'checkExtensionByMimeType'=>false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article1' => 'Полезная статья 1',
            'img1' => 'Превью 1',
            'article2' => 'Полезная статья 2',
            'img2' => 'Превью 2',
            'article3' => 'Полезная статья 3',
            'img3' => 'Превью 3',
        ];
    }
    
    public function getPreview()
    {
        return static::find()->one();
    }
    
    public function getArticles()
    {
        $rec = $this->getPreview();
        $article_id[] = $rec->article1;
        $article_id[] = $rec->article2;
        $article_id[] = $rec->article3;
        
        $articles = Page::find()->select(['h1', 'short_desc', 'alias'])->where(['id' => $article_id])->orderBy('id DESC')->all();
        
        return $articles;
    }
}
