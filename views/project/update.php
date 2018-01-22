<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'แก้ไข โครงการ:'.$model->projectname;
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->projectname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="project-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
