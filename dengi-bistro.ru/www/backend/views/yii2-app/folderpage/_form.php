<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Page;
/* @var $this yii\web\View */
/* @var $model backend\models\Folderpage */
/* @var $form yii\widgets\ActiveForm */

if($act=="create")
    $action=Url::toRoute(['folderpage/create']);
else if($act=="update")
    $action=Url::toRoute(['folderpage/update', 'id'=>$model->id]);
?>

<div class="folderpage-form">

    <?php $form = ActiveForm::begin(['action'=>$action]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php /*= $form->field($model, 'ids')->widget(Select2::className(), [
        'data' => Page::find()->select(['alias', 'id'])->indexBy('id')->column(),
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
