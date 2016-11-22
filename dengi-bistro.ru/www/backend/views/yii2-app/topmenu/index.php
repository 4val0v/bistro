<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TopmenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Верхнее меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topmenu-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пункт меню', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            //'id',
            'name',
            'alias',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
