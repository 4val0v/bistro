<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $model common\models\RecCompany */

$this->title = "Популярные предложения";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rec-company-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'company1',
            [
                'attribute'=>'company1',
                'value'=>Company::find()->where(['id'=>$model->company1])->one()->name
            ],
            [
                'attribute'=>'company2',
                'value'=>Company::find()->where(['id'=>$model->company2])->one()->name
            ],
            [
                'attribute'=>'company3',
                'value'=>Company::find()->where(['id'=>$model->company3])->one()->name
            ],
            //'company2',
            //'company3',
        ],
    ]) ?>

</div>
