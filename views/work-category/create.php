<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkCategory */

$this->title = 'สร้างหมวดงาน';
$this->params['breadcrumbs'][] = ['label' => 'หมวดงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="work-category-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
