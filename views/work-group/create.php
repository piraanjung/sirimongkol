<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */

$this->title = 'สร้างกลุ่มงาน';
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-create">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
