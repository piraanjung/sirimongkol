<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = $model->hm_name;
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="well">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'hm_code',
                'hm_name',
                'hm_control_statment',
                'hm_description:ntext',
            ],
        ]) ?>
    </div>
</div>
