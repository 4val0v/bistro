<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Company;

$data=Company::find()->select(['name','id'])->where(['!=','alias', ''])->andWhere(['!=', 'href', ''])->indexBy('id')->column();
/* @var $this yii\web\View */
/* @var $model common\models\RecCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rec-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company1')->widget(Select2::className(), [
        'data' => $data,
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите компанию'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'company2')->widget(Select2::className(), [
        'data' => $data,
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите компанию'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'company3')->widget(Select2::className(), [
        'data' => $data,
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите компанию'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
