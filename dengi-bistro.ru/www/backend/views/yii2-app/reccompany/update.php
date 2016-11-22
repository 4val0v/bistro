<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RecCompany */

$this->title = 'Редактировать предложения';
$this->params['breadcrumbs'][] = ['label' => "Популярные предложения", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="rec-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
