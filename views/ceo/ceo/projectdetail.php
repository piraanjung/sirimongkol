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
<div class="box box-success">
<div class="row box-detail">
    <div class="col-xs-12 col-md-3" style="background-color:#74CC93;height:360px">
        <div class="project">
            <h2 style="color:#FFFFFF; text-align:center;">สิริมงคล</h2> 
            <div class="project-number"><?=substr($houseCount[0]['project_id'],-1);?></div>
        </div>
       </div>
    <div class="col-xs-12 col-md-3">
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">จำนวนบ้าน</div>
            <div class="_content">
                <div>&nbsp;</div>
                <span class="big-text"><?=count($houseCount);?></span>
                <span class="small-text">หลัง</span>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">ความคืบหน้าการก่อสร้าง</div>
            <div class="_content">
                <div>
                    <span class="small-text">บ้านแล้วเสร็จ</span>
                    <span class="big-text"><?=$completeBuildedHoueses;?></span>
                    <span class="small-text">หลัง</span>
                </div>
                <div>
                    <span class="small-text">กำลังก่อสร้าง</span>
                    <span class="big-text"><?=$duringBuildedHouses;?></span>
                    <span class="small-text">หลัง</span>
                </div>
                <div>
                    <span class="small-text">ยังไม่ดำเนินการ</span>
                    <span class="big-text">
                        <?=count($houseCount)-($completeBuildedHoueses+$duringBuildedHouses);?>
                    </span>
                    <span class="small-text">หลัง</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">งบก่อสร้าง</div>
            <div class="_content">
                <div>&nbsp;</div>
                <span class="big-text"><?=number_format($project['control_statement'],2);?></span>
                <span class="small-text">บาท</span>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">จ่ายแล้ว</div>
                <div class="_content">
                <div>&nbsp;</div>
                <span class="big-text"><?=number_format($sumPaidAmountByProject,2);?></span>
                <span class="small-text">บาท</span>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">ระยะเวลาการก่อสร้าง</div>
            <div class="_content">
                <div  class="big-text">1 มกราคม 2560</div>
                <div  class="big-text" style="text-align:center">-</div>
                <div  class="big-text">1 มกราคม 2560</div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12 content">
            <div class="_header">จ่ายแล้ว : งบก่อสร้าง</div>
            <div class="_content">
                <div>&nbsp;</div>
                <span class="big-text">
                <?=number_format(($sumPaidAmountByProject*100)/$project['control_statement'],2);?>
                </span>
                <span class="small-text">%</span>
            </div>
        </div>
    </div>
</div><!-- row -->
</div><!-- well -->

   

<div class="box box-success">
<div class="box-body">
<?= GridView::widget([
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
?>

</div>
    
</div>
