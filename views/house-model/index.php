<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HouseModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่าแบบบ้าน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
          <div class="box-header">
            <p>
                <?= Html::a('สร้างแบบบ้าน', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'hm_code',
                        'hm_name',
                        'hm_control_statment',
                        'hm_description:ntext',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
    </div>
</div>
