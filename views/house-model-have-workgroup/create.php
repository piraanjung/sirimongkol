<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = 'Create House Model Have Workgroup';
$this->params['breadcrumbs'][] = ['label' => 'House Model Have Workgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-have-workgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
