<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\WorkGroup;

$ints_sum =$instalment_sum_provider->getModels();
$percent = ($ints_sum[0]['sum_paid_amount']/$ints_sum[0]['sum_cost_control'])*100;
$class = $percent < 100 ? 'bg-yellow' : '';
// print_r($instalment_sum_provider);
?>

<div class="box box-success">
    <?= GridView::widget([
            'dataProvider' => $instalment_sum_provider,
            // 'filterModel'=> $searchModel ,
            'showPageSummary'=>true,
            // 'striped'=> $percent<100 ? true : false,
            'pjax'=>true,
            'columns' => [
                [
                    'class'=>'kartik\grid\SerialColumn',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ?  ['class' => 'bg-yellow'] : [];
                    }, 
                ],
                
                [
                    'attribute' => 'wg_name',
                    'header' => 'กลุ่มงาน',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:left', 'class' => 'bg-yellow'] : ['style'=> 'text-align:left'];
                    },
                    'value' => function($model){

                        return $model['wg_name'];
                    }
                ],
                [
                    'attribute' => 'cost_control',
                    'header' => 'งบควบคุม',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        return $model['cost_control'];
                    },
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryOptions'=>['class'=>'text-right text-warning'],
                ],
                [
                    'attribute' =>'paid_amount',
                    'header' => 'จ่ายแล้ว',
                    
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        $a = $model['paid_amount'] > 0 ? $model['paid_amount'] : 0;
                        return $a;
                    },
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryOptions'=>['class'=>'text-right text-warning'], 
                ],
                [
                    'header' =>'%',
                    'contentOptions' =>  function($model, $key, $index, $widget){
                        return $model['progress_percent']> 100 ? ['style'=> 'text-align:right', 'class' => 'bg-yellow'] : ['style'=> 'text-align:right'];
                    },
                    'value' => function($model){
                        return $model['progress_percent'] == '' ? 0 : $model['progress_percent'];
                    },
                    'format'=>['decimal', 2],
                ]

            ],
            
        ]);


    ?>
</div>