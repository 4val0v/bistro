<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use common\models\Offer;
use backend\models\Folderpage;

mihaildev\elfinder\Assets::noConflict($this);
/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offer_id')->widget(Select2::className(), [
        'data' => Offer::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите оффер'],
        'pluginOptions' => [
            'allowClear' => true,
        ], 
    ])?>

    <?= $form->field($model, 'folder')->widget(Select2::className(), [
        'data' => Folderpage::find()->select(['name', 'id'])->indexBy('id')->column(),
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Выберите папку'],
        'pluginOptions' => [
            'allowClear' => true,
        ], 
    ])?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>

    <?=$form->field($model, 'text_1')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);
    /*$form->field($model, 'text_1')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', 
            'inline' => false, 
        ],
    ]);*/?>
    
    <?= $form->field($model, 'marked')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'expert_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expert_text')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);?>

    <?= $form->field($model, 'text_2')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions(['elfinder'],[]),
        ]);?>

    <?= $form->field($model, 'helpfull')->dropDownList(['0'=>'Не показывать','1'=>'Показывать']) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_keys')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
/*
$url2=Url::toRoute(["page/nameurl"]);
$script = <<< JS
    $('#page-h1').change(function(){
       var name=$(this).val();
      $.get('$url2', {name : name}, function(data){
        var data= $.parseJSON(data);
        $('#page-alias').val(data.alias);        
       }); 
    });
JS;
$this->registerJs($script);*/
?>