<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */

$this->title = 'ผูกแบบบ้านกับกลุ่มงาน';
$this->params['breadcrumbs'][] = ['label' => 'ผูกแบบบ้านกับกลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-have-workgroup-create">
    <div class="box box-success">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'workgroup' => $workgroup,
            'house_model' => $house_model
        ]) ?>
    </div>
</div>
