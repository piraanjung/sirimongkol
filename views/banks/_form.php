<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name[]')->dropDownList( 
        ['prompt'=>'เลือกธนาคาร...',
        'ธนาคารกรุงเทพ' => 'ธนาคารกรุงเทพ',
        'ธนาคารกสิกรไทย' => 'ธนาคารกสิกรไทย',
        'ธนาคารกรุงไทย' => 'ธนาคารกรุงไทย',
        'ธนาคารทหารไทย' => 'ธนาคารทหารไทย',
        'ธนาคารไทยพาณิชย์' => 'ธนาคารไทยพาณิชย์',
        'ธนาคารกรุงศรีอยุธยา' => 'ธนาคารกรุงศรีอยุธยา',
        'ธนาคารออมสิน' => 'ธนาคารออมสิน',
        'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร' => 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร']);?>

    <!-- <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'brance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
