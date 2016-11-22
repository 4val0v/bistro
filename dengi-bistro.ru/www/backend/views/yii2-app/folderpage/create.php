<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Folderpage */

$this->title = 'Create Folderpage';
$this->params['breadcrumbs'][] = ['label' => 'Folderpages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folderpage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
