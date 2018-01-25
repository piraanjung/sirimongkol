<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\DataColumn;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ceo\models\LaborcostdetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สรุปการจ่ายค่าแรง แปลงที่'.$instalment[0]['house_id'].
                " งวดที่ ".$instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'];
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลรายแปลง', 'url' => ['/ceo/laborcostdetails/index',
                                    'project_id'=>$instalment[0]['project_id'], 'instalment'=>$instalment[0]['instalment']]]; 
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    thead th{
        text-align:center;
    }
    .header{
        background-color:#358DC4;
        color:#ffffff;
    }
    td{
        text-align:center
    }
    .row_sum_by_wc{
        background-color:#43B2F7;
        font-weight:bold;
        color:#ffffff;
    }
    .number_format_td{
        text-align:right
    }
</style>
<div class="well">
    <h2><?=$this->title;?></h2>
    <table class ="table table-bordered">
        <thead>										
            <tr class="header">
                <th colspan="3">โครงการ สิริมงคล 6</th>
                <th colspan="3">สรุปการจ่ายค่าแรง</th>

                <th colspan="3">ประจำเดือน พ.ย 60</th>
            </tr>
            <tr class="header">
                <th>งวดที่ 
                    <?php
                        echo $instalment[0]['instalment_monthly']."/".$instalment[0]['instalment'];
                    ?>
                </th>
                <th colspan="2">แบบบ้าน <?=$instalment[0]['house_model_name'];?></th>
                
                <th colspan="3">การจ่ายเงิน</th>
                <th colspan="2">แปลง <?=$instalment[0]['house_id'];?></th>
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
                    <td><?=$ins['wc_name'];?></td>
                    <td><?=$ins['work_type_name'];?></td>
                    <td class="number_format_td"><?=number_format($ins['ceiling_money'],2);?></td>
                    <td><?=$ins['instalment_monthly']."/".$ins['instalment'].".".$ins['instalment_year'];?></td>	
                    <td class="number_format_td"><?=number_format($ins['amount'],2);?></td>
                    <td><?=$ins['moneytype'];?></td>
                    <td><?=$ins['constructorname'];?></td>
                    <td><?=$ins['comment'];?></td>
                    <td class="number_format_td"><?=number_format($ins['amount'],2);?></td>
                    <?php
                        $sum_ceiling_budget_by_workclassify += $ins['ceiling_money'];
                        $sum_amount_by_workclassify += $ins['amount'];
                        $total_amount += $ins['amount'];
                        $total_ceiling += $ins['ceiling_money'];
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
    <!-- <\app\models\Form::print_array($instalment);?> -->
</div>    