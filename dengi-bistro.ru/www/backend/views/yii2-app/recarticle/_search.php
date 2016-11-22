<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RecArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rec-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article1') ?>

    <?= $form->field($model, 'img1') ?>

    <?= $form->field($model, 'article2') ?>

    <?= $form->field($model, 'img2') ?>

    <?php // echo $form->field($model, 'article3') ?>

    <?php // echo $form->field($model, 'img3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
