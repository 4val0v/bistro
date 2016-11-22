<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RecArticle */

$this->title = 'Полезные статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rec-article-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'article1',
            //'img1',
            [
                'attribute'=>'img1',
                'value'=>'/frontend/web/img/'.$model->img1,
                'format' => ['image',['width'=>'60px']],
            ],
            'article2',
            [
                'attribute'=>'img2',
                'value'=>'/frontend/web/img/'.$model->img2,
                'format' => ['image',['width'=>'60px']],
            ],
            'article3',
            [
                'attribute'=>'img3',
                'value'=>'/frontend/web/img/'.$model->img3,
                'format' => ['image',['width'=>'60px']],
            ],
        ],
    ]) ?>

</div>
