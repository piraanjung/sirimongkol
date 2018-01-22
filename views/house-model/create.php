<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HouseModel */

$this->title = 'สร้างแบบบ้านl';
$this->params['breadcrumbs'][] = ['label' => 'ตั้งค่าแบบบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
