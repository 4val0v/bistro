<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Topmenu */

$this->title = 'Создать пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Верхнее меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topmenu-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
