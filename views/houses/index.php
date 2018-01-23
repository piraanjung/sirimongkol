<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แปลงบ้าน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="well">
        <p>
            <?= Html::a('สร้างแปลงบ้าน', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
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
                     $project = app\models\Project::find()->where(['id' => $model['project_id']])->one();
                     return $project['projectname'];   
                    }   
                ],
                
                [
                    'attribute' => 'house_status',
                    'value'     => function($model){
                        $hs = app\models\Houses::find()->where(['id' => $model['house_status']])->one();
                     return $hs['house_status'];   
                    }
                ],
                
                // 'house_status',
                //'create_date',
                //'update_date',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
