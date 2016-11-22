<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Footermenu */

$this->title = 'Редактировать пункт меню: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню подвала', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировтаь';
?>
<div class="footermenu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
