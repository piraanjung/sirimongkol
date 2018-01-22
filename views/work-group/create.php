<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WorkGroup */

$this->title = 'Create Work Group';
$this->params['breadcrumbs'][] = ['label' => 'Work Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
