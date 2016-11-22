<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать компанию', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Загрузить из файла', ['load'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="row">
        <div class="col-sm-3">
            <li class="list-group-item" style="<?php if(!$active){echo "background-color: #f2f2f2;";} ?>">
                <a style="<?php if(!$active){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["company/index"]);?>">Все</a>
            </li>
            <li class="list-group-item" style="<?php if($active){echo "background-color: #f2f2f2;";} ?>">
                <a style="<?php if($active){echo "text-decoration: underline;";} ?>" href="<?= Url::toRoute(["company/index", 'active'=>1]);?>">Активные</a>
            </li>
        </div>
    </div>
    <h4><?php if($active){ echo "Активные"; }else { echo "Все страницы"; }?></h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            //'id',
            'name',
            'alias',
            'h1',
            'title',
            // 'seo_desc',
            // 'seo_keys',
            // 'desc:ntext',
            // 'lit_desc',
            // 'vk_group',
            // 'fb_group',
            // 'max_sum',
            // 'old',
            // 'pay',
            // 'watch',
            // 'stars',
            // 'raiting',
            // 'href',
            // 'checked',
            // 'last_upd',
        ],
    ]); ?>
</div>
