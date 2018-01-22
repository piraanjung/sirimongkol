<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'สร้างแปลงบ้าน';
$this->params['breadcrumbs'][] = ['label' => 'แปลงบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
