
<button class="btn btn-info btn-raised pull-right" id="printbtn">Print</button>
<br style="clear:both">
<div id="print">
    <h3>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  


    <?=\app\models\Instalment::date_of_instalment($models[0]['create_date']);?> 
    (งวด <?=$models[0]['monthly']."/".$models[0]['instalment'].".".$models[0]['year']?>)
    </h3>
    <div class="tabel table-responsive">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อช่าง</th>   
                    <th>เลขแปลงบ้าน</th>
                    <th>รายละเอียดงาน</th>
                    <th>ลักษณะงาน</th>
                    <th>งบควบคุม</th>
                    <th>จำนวนเงิน</th>
                    <th>หมายเหตุ</th>
                </tr>
                
            </thead>
            <tbody>
            <?php 
            $curname = $models[0]['contructor_id'];
            $sum_by_payee=0;
            $i=0;
            $showname = 1;
            $total =0;
            foreach($models as $model){
                if($curname != $model['contructor_id']  ){
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>
                               
                            </td>";
                    echo "</tr>";
                    
                    $curname = $model['contructor_id'];
                    $total+=$sum_by_payee;
                    $sum_by_payee =0;
                    $showname =1;
                ?>
                <tr>
                <td><?=++$i?></td>
                <td>
                <?php 
                    $payee = app\models\Payee::find()
                        ->where(['id'=>$model['contructor_id']])->one();
                        if($showname ==1){
                            echo $payee['name'];
                            $showname =0;
                        }
                ?>
                </td>   
                <td><?=$model['house_id'];?></td>
                <td>
                <?php 
                    $wc = \app\models\WorkClassify::find()
                        ->where(['id'=>$model['workclassify_id']])->one();
                    echo $wc['wc_name'];
                ?>
                </td>
                <td>
                <?php 
                    $wc = \app\models\MoneyType::find()
                        ->where(['id'=>$model['money_type_id']])->one();
                    echo $wc['name'];
                ?>
                </td>
                <td class="_number">
                    <?=number_format($model['ceiling_money'],2);?>
                </td>
                <td class="_number">
                <?php 
                    echo number_format($model['amount'],2);
                    $sum_by_payee += $model['amount'];
                ?>
                </td>
                <td><?=$model['comment'];?></td>
            </tr>
                <?php
                }else{
            ?>
                <tr>
                    <td><?=++$i?></td>
                    <td>
                    <?php 
                        $payee = app\models\User::find()
                            ->where(['id'=>$model['contructor_id']])->one();
                            if($showname ==1){
                                echo $payee['username'];
                                $showname =0;
                            }
                    ?>
                    </td>   
                    <td><?=$model['house_id'];?></td>
                    <td>
                    <?php 
                        $wc = \app\models\WorkCategory::find()
                            ->where(['id'=>$model['workclassify_id']])->one();
                        echo $wc['wc_name'];
                    ?>
                    </td>
                    <td>
                    <?php 
                        $wc = \app\models\MoneyType::find()
                            ->where(['id'=>$model['money_type_id']])->one();
                        echo $wc['name'];
                    ?>
                    </td>
                    <td class="_number">
                    <!-- <number_format($model['ceiling_money'],2);?> -->
                </td>
                    <td class="_number">
                    <?php 
                        echo number_format($model['amount'],2);
                        $sum_by_payee += $model['amount'];
                    ?>
                    </td>
                    <td><?=$model['comment'];?></td>
                </tr>
            <?php
        
                 
                }//else
                if($i == count($models)){
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>

                            </td>";
                    echo "</tr>";

                    $total+=$sum_by_payee;
                    $sum_by_payee  =0;
                   // $curname = $model['contructor_id'];
                 }
            }
            ?>
            <tr class=_total>
                <td  colspan="6">รวมทั้งสิ้น</td>
                <td class="_number"><?=number_format($total,2);?></td>
                <td>
                    
                </td>
            </tr>
            </tbody>
        </table>
    </div>
   


</div>