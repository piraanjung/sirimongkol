<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\WorkGroup;

$ints_sum =$instalment_sum_provider->getModels();
$percent = ($ints_sum[0]['sum_paid_amount']/$ints_sum[0]['sum_cost_control'])*100;

?>

<div class="box box-success">
    <?= GridView::widget([
            'dataProvider' => $instalment_sum_provider,
            'filterModel'=> $searchModel ,
            'showPageSummary'=>true,
            'striped'=> $percent<100 ? true : false,
            'pjax'=>true,
            'options' => ['class' => $percent > 100 ? 'bg-yellow':''],
            'columns' => [
                ['class'=>'kartik\grid\SerialColumn'],
                
                [
                    'attribute' => 'wg_name',
                    'header' => 'กลุ่มงาน',

                    'contentOptions' => ['style'=> 'text-align:left'],
                    'value' => function($model){
                        return $model['wg_name'];
                    }
                ],
                [
                    'attribute' =>'paid_amount',
                    'header' => 'จ่ายแล้ว',
                    
                    'contentOptions' => ['style'=> 'text-align:right'],
                    'value' => function($model){
                        $a = $model['paid_amount'] > 0 ? $model['paid_amount'] : 0;
                        return $a;
                    },
                    'format'=>['decimal', 0],
                    'pageSummary'=>true,
                    
                ],

            ],
            
        ]);


    ?>
</div>