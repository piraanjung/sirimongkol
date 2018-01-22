<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = 'แก้ไขแบบบ้าน:'.$model->hm_name;
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hm_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="house-model-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
