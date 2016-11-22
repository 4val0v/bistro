<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Offer;
/* @var $this yii\web\View */
/* @var $model backend\models\Folderoffer */
/* @var $form yii\widgets\ActiveForm */

if($act=="create")
    $action=Url::toRoute(['folderoffer/create']);
else if($act=="update")
    $action=Url::toRoute(['folderoffer/update', 'id'=>$model->id]);
?>


<div class="folderoffer-form">

    <?php $form = ActiveForm::begin(['action'=>$action]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php /*= $form->field($model, 'ids')->widget(Select2::className(), [
        'data' => Offer::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ], 
        ])*/?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
