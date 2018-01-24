<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InstalmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จ่ายงวด';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instalment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="well">
    <p>
        <?= Html::a('สร้างงวดจ่ายเงิน', ['create'], ['class' => 'btn btn-success btn-raised']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'instalment',
            'monthly',
            'year',
            'project_id',
            [
                'attribute' =>'editor_id',
                'value'     => function($model){
                    $user = \app\models\User::find()
                                ->where(['user.id' => $model->editor_id])->one();
                    return $user['username'];
                }
            ],
            // 'create_date',
            // 'update_date',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{add_item} {paid_by} {details}',
                'width' => '35%',
                'header' => '',
                'buttons'=>[

                    'add_item'=> function($url, $model){
                            // $t = 'instalment/instalment_by_instructor&instalment_id='.$model->id;
                            return Html::a('1.จ่ายเงินรายช่าง', 
                            ['employee/instalment/instalment_by_instructor','instalment_id'=>$model->id],
                                ['class'=> 'btn btn-primary  custom_button']
                            );
                        },
                    'paid_by'=> function($url, $model){
                        // $t = 'employee/instalment/instalment_by_instructor&instalment_id='.$model->id;
                        return Html::a('2.เลือกวิธีจ่าย','index.php?r=with-drawn&instalment_id='.$model->id,
                                ['class' => 'btn btn-success']);
                    },
                    'details'=> function($url, $model){
                        // $t = 'employee/instalment/instalment_by_instructor&instalment_id='.$model->id;
                        return Html::a('3.รายงานสรุป', 
                        ['employee/instalment/instalment_by_instructor_detail','instalment_id'=>$model->id],
                            ['class'=> 'btn btn-primary  custom_button']
                        );
                    },
                ]
            ],
        ],
    ]); ?>    

    </div>
</div>
