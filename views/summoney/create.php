<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Summoney */

$this->title = 'Create Summoney';
$this->params['breadcrumbs'][] = ['label' => 'Summoneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="summoney-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
