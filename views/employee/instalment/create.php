<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Instalment */

$this->title = 'สร้างงวดจ่ายเงิน';
$this->params['breadcrumbs'][] = ['label' => 'งวดจ่ายเงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instalment-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
      <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'monthly' =>$monthly
        ]) ?>
       </div> 
    </div>
</div>
