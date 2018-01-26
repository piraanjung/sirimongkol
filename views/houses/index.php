<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แปลงบ้าน';
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->session->hasFlash('alert')){
    echo \yii\bootstrap\Alert::widget([
    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]);
    } 
?>
<div class="houses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
      <div class="box-header">
        <p>
            <?= Html::a('สร้างแปลงบ้าน', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        </div>
        <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'house_name',
                [ 
                    'attribute' => 'house_model_id',
                    'value' => function($model){
                        $hm = app\models\HouseModel::find()->where(['id' => $model['house_model_id']])->all();
                      
                        return $hm[0]['hm_name'];
                    }
                ],
                [
                    'attribute' => 'project_id',  
                    'value'     => function($model){
                     $project = app\models\Project::find()->where(['project_id' => $model['project_id']])->one();
                     return $project['projectname'];   
                    }   
                ],
                
                [
                    'attribute' => 'house_status',
                    'value'     => function($model){
                        $hs = app\models\Houses::find()->where(['house_status' => $model['house_status']])->one();
                        return \app\models\Methods::house_status($hs['house_status']);   
                    }
                ],
                
                

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>
</div>
