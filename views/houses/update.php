<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'แก้ไขแปลงบ้าน:'.$model->house_name;
$this->params['breadcrumbs'][] = ['label' => 'Houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="houses-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
