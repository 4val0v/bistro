<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

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
            'h1',
            'alias',
            'folder:ntext',
            //'offer_id',
            [
                'attribute'=>'offer_id',
                'value'=> ArrayHelper::getValue($model, 'offer.name')
            ],
            'text_1:ntext',
            'marked:ntext',
            'expert_text:ntext',
            'text_2:ntext',
            'helpfull',
            'seo_title',
            'seo_desc:ntext',
            'seo_keys:ntext',
            'expert_title',
        ],
    ]) ?>

</div>
