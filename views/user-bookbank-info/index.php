<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserBookbankInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลธนาคารของผู้ใช้ระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-bookbank-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="box box-success">
    <div class="box-header">
    <p>
        <?= Html::a('เพิ่มข้อมูลธนาคารของผู้ใช้ระบบ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'user_id',
            'bank_id',
            'account_bank',
            'create_date',
            'update_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
