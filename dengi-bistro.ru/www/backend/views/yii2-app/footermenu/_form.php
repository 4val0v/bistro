<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Page;

$data=Page::find()->select(['alias'])->indexBy('alias')->asArray()->column();
$arr=['vse-kompanii'=>'vse-kompanii', 'blog'=>'blog'];
$data=array_merge($arr, $data);
/* @var $this yii\web\View */
/* @var $model common\models\Footermenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="footermenu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->widget(Select2::className(), [
        'data' => $data,
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите урл страницы'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'position')->dropDownList([1=>'1я колонка', 2=>'2я колонка', 3=>'3я колонка', 4=>'4я колонка']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
