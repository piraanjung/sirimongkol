<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */

$this->title = 'เพิ่มข้อมูลธนาคารของผู้ใช้ระบบ';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลธนาคาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-create">

    <h1><?= Html::encode($this->title) ?></h1>
 <div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
