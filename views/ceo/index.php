<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use app\modules\models\Houses;
/* @var $this yii\web\View */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well">
    <h2>ความคืบหน้าโครงการ</h2>
    <?php foreach ($boxs as $box) {?>
    <table class="table dashboard" border="1" style="background-color: #3F51aa; color:#ffffff">
        <tr>
            <td rowspan="2">
                <h1 class="text-center"><?=$box['projectname'];?></h1> 
                <center>
                <?= Html::a('รายละเอียด', ['site/projectdetail', 'project_id' => $box['project_id']]
                    ,['class'=>'btn labor_btn btn-raised'])?>
                </center> 
            </td>
            <td>จำนวนบ้าน
                <h3 class="text-center"><?=$box['unit_count']?> หลัง</h3>
            </td>
            <td>งบก่อสร้าง
                <h3 class="text-center"><?= number_format($box['values']) ?> บาท</h3>
            </td>
            <td>ระยะเวลาการก่อสร้าง
                <h3 class="text-center">1 มค. 2560 <br>-<br> 20 ธค. 2560</h3>
            </td>
        </tr>
        <tr>
            <td>ความคืบหน้าการก่อสร้าง
                <h4 class="text-center">บ้านเสร็จแล้ว 
                <?=$completeBuildedHoueses  = Houses::countHousesByStatus(2,$box['project_id']); ?>
                หลัง</h4>
                <h4 class="text-center">กำลังก่อสร้าง 
                <?=$duringBuildedHouses = Houses::countHousesByStatus(1, $box['project_id']);?>
                หลัง</h4>
                <h4 class="text-center">ยังไม้ดำเนินการ 
                <?=$noneBuildedHouses = Houses::countHousesByStatus(0, $box['project_id']);?>
            
                หลัง</h4>
            </td>
            <td>จ่ายแล้ว
                <h3 class="text-center"> 
                <?php 
                $sumPaidAmountByProject = Houses::sumPaidAmountByProject($box['project_id']);
                echo number_format($sumPaidAmountByProject,2);
                ?>
                บาท</h3>
            </td>
            <td>จ่ายแล้ว:งบก่อสร้างคิดเป็น
                <h3 class="text-center">
                <?=number_format(($sumPaidAmountByProject*100)/$box['values'],2);?>
                %</h3>
            </td>
        </tr>
    </table>
    <?php } ?>
</div>