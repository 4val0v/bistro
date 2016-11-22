<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Bottommenu */

$this->title = 'Создать пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Нижнее меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bottommenu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
