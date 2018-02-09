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
    <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
        <thead>
            <tr>
                <th>#</th>
                <th>แปลงบ้าน</th>
                <th>แบบบ้าน</th>
                <th>จ่ายเงินแล้ว (บาท)</th>
                <th>งบควบคุม (บาท)</th>
                <th>คิดเป็น (%)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($provider->getModels() as $model){
                    $query = new Query();
                    $query->select(['sum(amount) as _total'])
                    ->from('instalmentcostdetails')
                    ->where(['house_id' =>$model['id']]);
                    $command = $query->createCommand();
                    // $command->sql returns the actual SQL
                    $rows = $command->queryAll();

                    $progress_percent = ($rows[0]['_total']/$model['hm_control_statment'])*100;
            ?>
            <tr class="<?=$rows[0]['_total']>100 ? '_normal' : '_abnormal';?>">
                <td><?=$i++;?></td>
                <td><?=$model['house_name'];?></td>
                <td><?=$model['hm_name'];?></td>
                <td class="number_format_td"><?=number_format($rows[0]['_total'],2)?></td>
                <td class="number_format_td"><?=number_format($model['hm_control_statment'],2);?></td>
                <td class="number_format_td"><?=number_format($progress_percent,2);?></td>
                <td>
                    <?=Html::a('รายละเอียด', ['/ceo/laborcostdetails/instalmentdetail_by_house',
                            'id'=>$model['id'], 'project_id' => $model['project_id']],
                                ['class'=> 'btn    btn-info']);
                    ?>
                </td>
            </tr>
            <?php    
                }//foreach
            ?>
        </tbody>
    </table>
    <!-- < Gridview::widget([
            'dataProvider'=> $provider,
            // 'filterModel' => $searchModel,
            // 'columns' => $gridColumns,
            'responsive'=>true,
            'hover'=>true,
            'columns'=>[
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' =>'house_name',
                    'header' => 'แปลงบ้าน',
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
                    'header' => 'จำนวนงวด',
                    'value' => function($model){
                        return $model['house_status'];
                    }
                ],
                [
                    'attribute' =>'',
                    'header' => 'จ่ายเงินแล้ว',
                    'value' => function($model){
                            $query = new Query();
                            $query->select(['sum(amount) as _total'])
                            ->from('instalmentcostdetails')
                            ->where(['house_id' =>$model['id']]);
                            $command = $query->createCommand();
                            // $command->sql returns the actual SQL
                            $rows = $command->queryAll();

                        return $rows[0]['_total'];
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
                    'header' => 'สถานะการจ่ายเงิน',
                    'value' => function($model){
                        $query = new Query();
                            $query->select(['sum(amount) as _total'])
                            ->from('instalmentcostdetails')
                            ->where(['house_id' =>$model['id']]);
                            $command = $query->createCommand();
                            // $command->sql returns the actual SQL
                            $rows = $command->queryAll();

                        $res = ($rows[0]['_total']/$model['hm_control_statment'])*100;
                        if($res > 100 ){
                            return number_format($res,2);
                        }else{
                            return number_format($res,2);
                        }
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
    ?> -->
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
