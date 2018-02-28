<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ceo\models\LaborcostdetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สรุปการจ่ายค่าแรง แปลงที่'.$instalment[0]['house_id'];
                // " งวดที่ ".$instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'].
                // ".".$instalment[0]['instalment_year'];
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลรายแปลง', 
                'url' => 'index.php?r=ceo/ceo/projectdetail&project_id='.$instalment[0]['project_id']]; 
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div class="box box-success">
<div class='box-body'>
  
    <h2><?=$this->title;?></h2>
    <div>
        <?=$this->render('_instalment_by_house_header',[
                    'instalment' => $instalment,
                ])
        ?>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#_instalment_sum" data-toggle="tab" aria-expanded="false">สรุป</a></li>
        <li class=""><a href="#_by_instalment" data-toggle="tab" aria-expanded="false">งวดงาน</a></li>
        <li class=""><a href="#workgroup" data-toggle="tab" aria-expanded="false">กลุ่มงาน</a></li>
        <li class=""><a href="#instalmentdetails" data-toggle="tab" aria-expanded="true">รายละเอียด</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="_instalment_sum">
            <?=$this->render('_instalment_summary',[
                    'instalment' => $instalment,
                    'instalment_sum_provider' => $instalment_sum_provider,
                    'searchModel' => $searchModel
                ]);
            ?>
        </div>
        <div class="tab-pane" id="_by_instalment">
            <?=$this->render('_instalment_by_instalment',[
                    'instalment' => $instalment,
                    // 'instalment_sum_provider' => $instalment_sum_provider,
                    // 'searchModel' => $searchModel
                ]);
            ?>
        </div>

        <div class="tab-pane" id="workgroup">
            <?=$this->render('_instalment_by_house_workgroup',[
                    'instalment' => $instalment,
                ]);
            ?>
        </div>

        <div class="tab-pane" id="instalmentdetails">
            <section class="content">
                <table class ="table table-bordered">
                    <thead>										
                        <tr class="header">
                            <th colspan="3">โครงการ <?=$instalment[0]['projectname'];?></th>
                            <th colspan="3">สรุปการจ่ายค่าแรง</th>

                            <th colspan="3">ประจำเดือน 
                            <?= \app\models\Methods::getMonth($instalment[0]['instalment_monthly'])." ".$instalment[0]['instalment_year'];?>
                            </th>
                        </tr>
                        <tr class="header">
                            <th>งวดที่ 
                                <?php
                                    echo $instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'].
                                        ".".$instalment[0]['instalment_year'];
                                ?>
                            </th>
                            <th colspan="2">แบบบ้าน <?=$instalment[0]['hm_name'];?></th>
                            
                            <th colspan="3">การจ่ายเงิน</th>
                            <th colspan="2">แปลง <?=$instalment[0]['hm_name'];?></th>
                            <th>ยอดสะสมถึงงวด</th>
                        </tr>
                        <tr class="header">
                            <th>หมวดงาน</th>
                            <th>งาน</th>
                            <th>วงเงินควบคุม</th>
                            <th>งวดที่จ่าย</th>	<th>จำนวนเงิน</th><th>ชนิดเงิน</th>
                            <th>ผู้รับเงิน</th>
                            <th>หมายเหตุ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $curr_wc_name = $instalment[0]['wc_name'];
                            $sum_ceiling_budget_by_workclassify = 0;
                            $sum_amount_by_workclassify=0;
                            $total_amount =0;
                            $total_ceiling =0;
                        ?>
                        <?php foreach($instalment as $key => $ins){?> 
                            <?php if($curr_wc_name != $ins['wc_name']){ ?>
                                    <tr class="row_sum_by_wc">
                                        <td colspan="2">รวม</td>
                                        <td class="number_format_td"><?=number_format($sum_ceiling_budget_by_workclassify,2);?></td>
                                        <td></td>
                                        <td class="number_format_td"><?=number_format($sum_amount_by_workclassify,2);?></td>
                                        <td colspan="3"></td>
                                        <td class="number_format_td"><?=number_format($total_amount,2);?></td>
                                    </tr>   
                                    <?php 
                                        $curr_wc_name = $ins['wc_name'];
                                        $sum_ceiling_budget_by_workclassify =0;
                                        $sum_amount_by_workclassify =0;
                                    ?>
                            <?php } //if $curr_wc_name != $ins['wc_name']?>
                            <tr>
                                <td class="work_despt"><?=$ins['wc_name'];?></td>
                                <td class="work_despt"><?=$ins['work_name'];?></td>
                                <td class="number_format_td"><?=number_format($ins['work_control_statement'],2);?></td>
                                <td><?=$ins['instalment_monthly']."/".$ins['instalment'].".".$ins['instalment_year'];?></td>	
                                <td class="number_format_td"><?=number_format($ins['amount'],2);?></td>
                                <td><?=$ins['moneytype'];?></td>
                                <td class="work_despt"><?=$ins['name'];?></td>
                                <td class="work_despt"><?=$ins['comment'];?></td>
                                <td class="number_format_td"><?=number_format($ins['amount'],2);?></td>
                                <?php
                                    $sum_ceiling_budget_by_workclassify += $ins['work_control_statement'];
                                    $sum_amount_by_workclassify += $ins['amount'];
                                    $total_amount += $ins['amount'];
                                    $total_ceiling += $ins['work_control_statement'];
                                ?>
                            </tr>

                            <?php if($key == count($instalment)-1){ ?>
                                    <tr class="row_sum_by_wc">
                                        <td colspan="2">รวม</td>
                                        <td class="number_format_td"><?=number_format($sum_ceiling_budget_by_workclassify,2);?></td>
                                        <td></td>
                                        <td class="number_format_td"><?=number_format($sum_amount_by_workclassify,2);?></td>
                                        <td colspan="3"></td>
                                        <td class="number_format_td"><?=number_format($sum_amount_by_workclassify,2);?></td>
                                    </tr> 
                                    <tr class="header">
                                        <td colspan="2">รวม</td>
                                        <td class="number_format_td"><?=number_format($total_ceiling,2);?></td>
                                        <td></td>
                                        <td class="number_format_td"><?=number_format($total_amount,2);?></td>
                                        <td colspan="3"></td>
                                        <td class="number_format_td"><?=number_format($total_amount,2);?></td>
                                    </tr> 
                                    <?php 
                                        $curr_wc_name = $ins['wc_name'];
                                        $sum_ceiling_budget_by_workclassify =0;
                                        $sum_amount_by_workclassify =0;
                                    ?>
                            <?php } //if $curr_wc_name != $ins['wc_name']  ?>
                        
                        <?php } //foreach?>
                    </tbody>
                </table> 	
            </section>
        </div>
        
    </div><!--tab-content-->
    <!-- <\app\models\Form::print_array($instalment);?> -->
</div>    
</div>

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>