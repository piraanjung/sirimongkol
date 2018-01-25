<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="box box-success">
   <div class="box-header">
    <p>
        <?= Html::a('สร้างกลุ่มงาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'wg_name',
            [
                'attribute' => 'wc_id',
                'value' => function($model){
                 $work_category = app\models\WorkCategory::find()->where(['id' => $model['wc_id']])->one(); 
                 return $work_category['wc_name'];  
                }
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>
