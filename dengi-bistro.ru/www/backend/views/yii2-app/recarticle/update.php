<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RecArticle */

$this->title = 'Редактировать полезнве стаьи';
$this->params['breadcrumbs'][] = ['label' => "Полезные стаьи", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="rec-article-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
