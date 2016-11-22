<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Page;
/* @var $this yii\web\View */
/* @var $model common\models\RecArticle */
/* @var $form yii\widgets\ActiveForm */

$art = Page::find()->select(['alias', 'id'])->indexBy('id')->column();

?>

<div class="rec-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article1')->widget(Select2::className(), [
        'data' => $art,
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ], 
        ])?>
    <?php if($model->img1){echo "<img style='width:100px;' src='/frontend/web/img/$model->img1' alt='img1' />";}?>
    <?= $form->field($model, 'img1')->fileInput() ?>

    <?= $form->field($model, 'article2')->widget(Select2::className(), [
        'data' => $art,
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ], 
        ])?>
    <?php if($model->img2){echo "<img style='width:100px;' src='/frontend/web/img/$model->img2' alt='img2' />";}?>
    <?= $form->field($model, 'img2')->fileInput() ?>

    <?= $form->field($model, 'article3')->widget(Select2::className(), [
        'data' => $art,
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ], 
        ])?>
    <?php if($model->img3){echo "<img style='width:100px;' src='/frontend/web/img/$model->img3' alt='img3' />";}?>
    <?= $form->field($model, 'img3')->fileInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
