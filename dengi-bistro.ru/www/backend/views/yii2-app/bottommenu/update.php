<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bottommenu */

$this->title = 'Редактировать пункт меню: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Нижнее меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="bottommenu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
