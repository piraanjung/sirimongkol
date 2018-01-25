<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'สร้างโครงการ';
$this->params['breadcrumbs'][] = ['label' => 'โครงการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
                    <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        
    </div>
    
