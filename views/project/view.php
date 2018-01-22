<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->projectname;
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

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
                'project_id',
                'projectname',
                'control_statement',
                'start_date',
                'end_date',
                
            ],
        ]) ?>
    </div>
</div>
