<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HouseModelHaveWorkgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-model-have-workgroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'house_model_id')->textInput() ?>

    <?= $form->field($model, 'wg_id')->textInput() ?>

    <?= $form->field($model, 'cost_control')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
