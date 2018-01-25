<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'สร้างแปลงบ้าน';
$this->params['breadcrumbs'][] = ['label' => 'แปลงบ้าน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
        <h1><?= Html::encode($this->title) ?></h1>
            <div class="box box-success">
               <?= $this->render('_form', [
                'model' => $model,
              ]) ?>
           </div>
            
      
    
    

