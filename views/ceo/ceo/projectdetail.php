<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\db\Query;

$this->title = 'รายละเอียดโครงการ ศิริมงคล '.substr($houseCount[0]['project_id'],-1) ;
$this->params['breadcrumbs'][] = ['label' => 'ความคืบหน้าโครงการ', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="owner-default-index">
    <?= $this->render('_projectdetail_header',[
        'houseCount' => $houseCount,
        'completeBuildedHoueses' => $completeBuildedHoueses,
        'duringBuildedHouses' => $duringBuildedHouses,
        'project' => $project,
        'sumPaidAmountByProject' => $sumPaidAmountByProject
    ]);
    ?>

   

<div class="box box-success">
<div class="box-body">
    
    <?= Gridview::widget([
            'dataProvider'=> $provider,
            // 'filterModel' => $searchModel,
            // 'columns' => $gridColumns,
            'responsive'=>true,
            'hover'=>true,
            'rowOptions' => function ($model) {
                $res = ($model['sum_amount']/$model['hm_control_statment'])*100;
                    return $res <= 100 ? ['class' => ''] : ['class' => 'danger'];
                }
            ,
            'columns'=>[
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' =>'house_name',
                    'header' => 'แปลงบ้าน',
                    'filter'=>array("1"=>"Active","2"=>"Inactive"),
                    'value' => function($model){
                        return $model['house_name'];
                    }
                ],
                [
                    'attribute' =>'hm_name',
                    'header' => 'แบบบ้าน',
                    'value' => function($model){
                        return $model['hm_name'];
                    }
                ],
                [
                    'attribute' =>'',
                    'header' => 'จำนวนกลุ่มงาน',
                    'vAlign' => 'right',
                    'value' => function($model){
                        return $model['workgroup_num'];
                    }
                ],
                [
                    'attribute' =>'amount',
                    'header' => 'จ่ายเงินแล้ว',
                    'value' => function($model){
                        return number_format($model['sum_amount'],2);
                    }
                ],
                [
                    'attribute' =>'hm_control_statment',
                    'header' => 'งบควบคุม',
                    'value' => function($model){
                        return number_format($model['hm_control_statment'],2);
                    }
                ],
                [
                    'attribute' =>'house_status',
                    'header' => 'คิดเป็น %',
                    'value' => function($model){
                        
                        $res = ($model['sum_amount']/$model['hm_control_statment'])*100;
                        return number_format($res,2)."%";
                    }
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{info}',
                    'width' => '20%',
                    'header' => '',
                    'buttons'=>[
        
                        'info'=>function($url, $model){
                            return Html::a('รายละเอียด', ['/ceo/laborcostdetails/instalmentdetail_by_house','id'=>$model['id'], 
                            'project_id' => $model['project_id']],
                                ['class'=> 'btn btn-raised btn-block  btn-success']);
                        },
                    ]
                ],
            ]
    ]);
    ?>
<!-- <= GridView::widget([
    'dataProvider'=> $dataProvider,
    // 'filterModel' => $searchModel,
    // 'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true,
    'columns'=>[
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'instalment_id',
            'header' => 'งวดที่',
            'value' => function($model){
                $month = $model['monthly'] <10 ? "0".$model['monthly'] : $model['monthly'];
                return $model['instalment_id']."/".$month.".".$model['year'];
            }
        ],
        [
            'attribute' => 'instalment_id',
            'header' => 'จำนวนที่จ่าย',
            'value' => function($model){
                return $model['instalment_id'];
            }
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{info}',
            'width' => '20%',
            'buttons'=>[

                'info'=>function($url, $model){
                    return Html::a('รายละเอียด', ['/ceo/laborcostdetails/index','id'=>$model['id'], 'instalment' => $model['instalment_id'], 
                    'house_id' => $model['house_id'], 'project_id'=>$model['project_id']],
                        ['class'=> 'btn btn-raised btn-block  btn-success']);
                },
            ]
        ],
    ]
]);
?> -->

</div>
    
</div>
