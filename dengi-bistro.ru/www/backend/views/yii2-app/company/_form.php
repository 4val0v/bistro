<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use kartik\rating\StarRating;
/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_keys')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', 
            'inline' => false, 
        ],
    ]);?>
    
    <?php if($model->img){echo "<img style='width:100px;' src='/frontend/web/img/$model->img' alt='img1' />";}?>
    <?= $form->field($model, 'img')->fileInput() ?>
    
    <?= $form->field($model, 'lit_desc')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'basic', 
            'inline' => false, 
        ],
    ]);?>

    <?= $form->field($model, 'vk_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_sum')->textInput() ?>
    
    <?= $form->field($model, 'max_termin')->textInput() ?>

    <?= $form->field($model, 'old')->widget(Select2::className(), [
        'data' => [1=>'18-19 лет', 2=>'20 лет',3=>'21 год и более'],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'pay')->widget(Select2::className(), [
        'data' => [1=>'Наличными', 2=>'На карту',3=>'На дом', 4=>'Яндекс.Деньги'],
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите способы', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'watch')->widget(Select2::className(), [
        'data' => ['5 минут'=>'5 минут','15 минут'=>'15 минут','1 час'=>'1 час','1 день'=>'1 день','несколько дней'=>'несколько дней','от недели'=>'от недели',],
        'size' => Select2::MEDIUM,
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])  
    ?>

    <?= $form->field($model, 'stars')->widget(StarRating::classname(), [
        'pluginOptions' => ['step' => 1]
    ]);?>

    <?= $form->field($model, 'raiting')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checked')->dropDownList([0=>'Нет', 1=>'Да']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
/*
$url2=Url::toRoute(["company/nameurl"]);
$script = <<< JS
    $('#company-name').change(function(){
       var name=$(this).val();
      $.get('$url2', {name : name}, function(data){
        var data= $.parseJSON(data);
        $('#company-alias').val(data.alias);        
       }); 
    });
JS;
$this->registerJs($script);*/
?>
