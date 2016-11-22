<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use kartik\slider\Slider;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#w0-slider
{
    width:100% !important;
}
</style>
<div class="site-contact">
<p>
  <label for="amount">Donation amount ($50 increments):</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
 
<input id="value" />
<div id="slider"></div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-12">

        </div>
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?php 
                echo Slider::widget([
                    'name'=>'rating_5',
                    'value'=>3,
                    'pluginOptions'=>[
                        'min'=>500,
                        'max'=>100000,
                        'step'=>500,
                        'tooltip'=>'always',
                        'formatter'=>new yii\web\JsExpression("function(val, step) { 
                            if (val <= 10000) {
                                step=step*2;
                                return val;
                            }
                            /*if (val > 10000 && val<=30000) {
                                return val*2;
                            }
                            if (val > 30000 && val<= 50000) {
                                return val*10;
                            }
                            if (val >5000 && val<100000) {
                                return val*20;
                            }*/
                        }")
                    ]
                ]);
                ?>
                

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
<?php
$str="";
for($i=500; $i<=10000;$i+=500)
$str.=$i.', ';
for($i=11000; $i<=30000;$i+=1000)
$str.=$i.', ';
for($i=35000; $i<=50000;$i+=5000)
$str.=$i.', ';
for($i=60000; $i<=100000;$i+=10000)
$str.=$i.', ';

echo $str;
?>