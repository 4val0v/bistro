<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Folderpage */

$this->title = 'Редактировать папку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Папки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="folderpage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
