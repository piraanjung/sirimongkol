<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'สร้างงาน';
$this->params['breadcrumbs'][] = ['label' => 'งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
