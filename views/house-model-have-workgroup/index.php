<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseModelHaveWorkgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'House Model Have Workgroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-have-workgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create House Model Have Workgroup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'house_model_id',
            'wg_id',
            'cost_control',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
