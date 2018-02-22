<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = 'Update House Model Have Workgroup: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'House Model Have Workgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="house-model-have-workgroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
