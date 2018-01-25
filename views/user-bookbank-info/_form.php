<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bookbank-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'bank_id')->dropDownList( 
        ['prompt'=>'เลือกธนาคาร...',
        'ธนาคารกรุงเทพ' => 'ธนาคารกรุงเทพ',
        'ธนาคารกสิกรไทย' => 'ธนาคารกสิกรไทย',
        'ธนาคารกรุงไทย' => 'ธนาคารกรุงไทย',
        'ธนาคารทหารไทย' => 'ธนาคารทหารไทย',
        'ธนาคารไทยพาณิชย์' => 'ธนาคารไทยพาณิชย์',
        'ธนาคารกรุงศรีอยุธยา' => 'ธนาคารกรุงศรีอยุธยา',
        'ธนาคารออมสิน' => 'ธนาคารออมสิน',
        'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร' => 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร']);?>

    <!-- <?= $form->field($model, 'bank_id')->textInput() ?> -->

    <?= $form->field($model, 'account_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
