<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Footermenu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню подвала', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="footermenu-view">

    <p>
        <?= Html::a('Удалить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Редактировать', ['delete', 'id' => $model->id], [
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
            'position',
        ],
    ]) ?>

</div>
