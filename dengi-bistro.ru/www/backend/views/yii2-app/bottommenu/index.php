<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BottommenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Нижнее меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bottommenu-index">

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
            'position',

            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
