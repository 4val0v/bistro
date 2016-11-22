<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Footermenu */

$this->title = 'Создать пункт меню';
$this->params['breadcrumbs'][] = ['label' => 'Меню подвала', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="footermenu-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
