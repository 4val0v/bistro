<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RecArticle */

$this->title = 'Create Rec Article';
$this->params['breadcrumbs'][] = ['label' => 'Rec Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rec-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
