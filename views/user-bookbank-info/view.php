<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookbankInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Bookbank Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-success">
        <p>
            <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'user_id',
                'bank_id',
                'account_bank',
                // 'create_date',
                // 'update_date',
            ],
        ]) ?>
    </div>
</div>
