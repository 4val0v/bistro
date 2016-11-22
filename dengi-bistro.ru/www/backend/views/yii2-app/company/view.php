<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Компании', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$arr=[0=>'Непроверенна', 1=>'Проверенна'];
$old=[1=>'18-19 лет', 2=>'20 лет', 3=>'21 год'];
function getPay($str)
{
    $s="";
    $mas=explode(',',$str);
    for($i=0;$i<count($mas);$i++)
    {
        if($mas[$i]==1)
            $s.="На карту,  ";
        else if($mas[$i]==2)
            $s.="Наличными,  ";
        else if($mas[$i]==3)
            $s.="На дом,  ";
        else if($mas[$i]==4)
            $s.="Яндекс.Деньги,  ";
    }
    $s= substr($s, 0, -3);
    return $s;
}
?>
<div class="company-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'alias',
            'h1',
            'title',
            'seo_desc',
            'seo_keys',
            'desc:ntext',
            [
                'attribute'=>'img',
                'value'=>'/frontend/web/img/'.$model->img,
                'format' => ['image',['width'=>'60px']],
            ],
            'lit_desc',
            'vk_group',
            'fb_group',
            'max_sum',
            //'old',
            [
                'attribute'=>'old',
                'value'=>$old[$model->old]
            ],
            //'pay',
            [
                'attribute'=>'pay',
                'value'=>getPay($model->pay)
            ],
            'watch',
            'stars',
            'raiting',
            'href',
            //'checked',
            [
                'attribute'=>'checked',
                'value'=>$arr[$model->checked]
            ],
            //'last_upd',
        ],
    ]) ?>

</div>
