
<table class="table table-striped table-bordered ">
    <thead>
        <tr>
            <th style="width:2%;text-align:center">#</th>
            <th style="width:8%;text-align:center">แปลงบ้าน</th>
            <th style="width:18%;text-align:center">ชื่อช่าง</th>
            <th style="width:8%;text-align:center">งวดที่</th>
            <th style="width:15%;text-align:center">หมวดงาน</th>
            <th style="width:15%;text-align:center">กลุ่มงาน</th>
            <th style="width:15%;text-align:center">งาน</th>
            <th style="width:12%;text-align:center">จำนวนจ่าย(บาท)</th>
            <th style="width:10%;text-align:center">ประเภทงาน</th>
            <th style="text-align:center"></th>
        </tr>
    </thead>
    <tbody>
        <?php $c=0;$i=1;?>
     <?= \app\models\Methods::print_array($addlist);?>
        <?php foreach($addlist as $ls){ ?>
            
            <?php if($ls['paid_type']==1){ ?>
                <tr>
                    <td><?=$i++;?></td>
                    <td>
                        <?php
                            $house = \app\models\Houses::find()->select('house_name')
                                ->where(['id' =>$ls['Instalmentcostdetails']['house_id']])->one();
                            echo count($house) == 0 ? "-" : $house['house_name'];
                        ?>
                        <input type="hidden" name="aa[house_id][]" value="<?=$ls['Instalmentcostdetails']['house_id'];?>">
                    </td>

                    <td>
                        <?php
                            $payee = \app\models\Profile::find()->select('name')
                            ->where(['user_id' => $ls['Instalmentcostdetails']['contructor_id']])->one();
                            echo $payee['name'];
                        ?>
                        <input type="hidden" name="aa[contructor_id][]" value="<?=$ls['Instalmentcostdetails']['contructor_id'];?>">
                    </td>
                    <td>
                        <?php
                            $instalment_no = \app\models\Instalment::find()->select('instalment')
                                ->where(['id' => $ls['Instalmentcostdetails']['instalment_id']])->one();
                            echo $instalment_no['instalment'];
                        ?>
                        <input type="hidden" name="aa[instalment_id][]" value="<?=$ls['Instalmentcostdetails']['instalment_id'];?>">
                    </td>
                    
                    <td>
                        <?php
                            $work_classify_id = \app\models\WorkCategory::find()->select('wc_name')
                                ->where(['id' => $ls['Instalmentcostdetails']['workclassify_id']])->one();
                                echo count($work_classify_id) ==0 ? "-" : $work_classify_id['wc_name'];
                            ?>
                            <input type="hidden" name="aa[workclassify_id][]" value="<?=$ls['Instalmentcostdetails']['workclassify_id'];?>">
                    </td>
                    
                    <td>
                        <?php 
                            $worktype = \app\models\WorkGroup::find()->select('wg_name')
                                ->where(['id'=> $ls['Laborcostdetails']['workgroup']])->one();
                                echo count($worktype) == 0 ? "-" : $worktype['wg_name'];
                        ?>
                        <input type="hidden" name="aa[work_type][]"  value="<?=$ls['Laborcostdetails']['workgroup'];?>">
                    </td>            
                    <td>
                        <?php 
                            $worktype = \app\models\Works::find()->select('work_name')
                                ->where(['id'=> $ls['Laborcostdetails']['workgroup']])->one();
                            echo count($worktype) == 0 ? "-" : $worktype['work_name'];
                        ?>
                        <input type="hidden" name="aa[work_type][]"  
                            value="<?=$ls['Laborcostdetails']['workgroup'];?>">
                    </td>
                    <td style="text-align:right">
                        <?=number_format($ls['Instalmentcostdetails']['amount'],2);?>
                            <input type="hidden" name="aa[amount][]" value="<?=$ls['Instalmentcostdetails']['amount'];?>">
                    </td>
                    <td>
                        <?php
                        $money_type = \app\models\MoneyType::find()->select('name')
                            ->where(['id' => $ls['Instalmentcostdetails']['money_type_id']])->one();
                        echo $money_type['name'];
                        ?>
                        <input type="hidden" name="aa[money_type_id][]" value="<?=$ls['Instalmentcostdetails']['money_type_id'];?>">
                    </td>
                    <td style="width:20%">
                        <?= \yii\helpers\Html::a('ลบ',['unset-array', 'id'=>$c++, 'instalment_id' => $ls['Instalmentcostdetails']['instalment_id']], 
                                ['class'=>'btn btn-danger btn-md btn-raised']);?>
                    </td>

                </tr>
            
            <?php }else{ ?>
                <!-- paid_type =2 -->
                <?php foreach($ls['deduction'] as $key => $dd) {?>  
                    
                    <?php if(!empty($ls['deduction']['loan_deduction']) || !empty($ls['deduction']['equipment_deduction'])){ ?> 
                        <tr>
                            <td><?=$i++;?></td>
                            <td>
                                <?php echo "-";?>
                                <input type="hidden" name="aa[house_id][]" value="<?=$ls['Instalmentcostdetails']['house_id'];?>">
                            </td>
                            <td>
                                <?php
                                    $payee = \app\models\Profile::find()->select('name')
                                    ->where(['user_id' => $ls['Instalmentcostdetails']['contructor_id']])->one();
                                    echo $payee['name'];
                                ?>
                                <input type="hidden" name="aa[contructor_id][]" value="<?=$ls['Instalmentcostdetails']['contructor_id'];?>">
                            </td>
                            <td>
                                <?php echo "-"; ?>
                                <input type="hidden" name="aa[instalment_id][]" value="<?=$ls['Instalmentcostdetails']['instalment_id'];?>">
                            </td>
                            
                            <td>
                                <?php echo "-"; ?>
                                <input type="hidden" name="aa[workclassify_id][]" value="<?=$ls['Instalmentcostdetails']['workclassify_id'];?>">
                            </td>
                            
                            <td>
                                <?php echo "-";
                                ?> 
                                <input type="hidden" name="aa[work_type][]"  value="<?=$ls['Laborcostdetails']['workgroup'];?>">
                            </td>          
                            <td>
                                <?php 
                                    $type = $key == "loan_deduction" ? 3 : 4;
                                    $worktype =\app\models\MoneyType::find()->select('name')
                                        ->where(['id'=> $type])->one();
                                    echo $worktype['name'];
                                ?>
                                <input type="hidden" name="aa[work_type][]"  value="<?=$type;?>">
                            </td>  
                            
                            <td style="text-align:right">
                                <?php
                                    $_amount = $key == 'loan_deduction'? $ls['deduction']['loan_deduction']['amount'] : 
                                                        $ls['deduction']['equipment_deduction']['amount'];
                                    echo $_amount;
                                ?>
                                    <input type="hidden" name="aa[amount][]" value="<?=$_amount;?>">
                            </td>
                            <td>
                                <?php
                                    $type = $key == "loan_deduction" ? 3 : 4;
                                    $money_type = \app\models\MoneyType::find()->select('name')
                                        ->where(['id' => $type])->one();
                                    echo $money_type['name'];
                                ?>
                                <input type="hidden" name="aa[money_type_id][]" value="<?=$type;?>">
                            </td>
                            <td style="width:20%">
                                <?= \yii\helpers\Html::a('ลบ',['unset-array', 'id'=>$c++, 'instalment_id' => $ls['Instalmentcostdetails']['instalment_id']], 
                                        ['class'=>'btn btn-danger btn-md btn-raised']);?>
                            </td>

                        </tr>
                    <?php } ?>
                <?php } //foreach?>
            <?php } //else?>
        
        
        <?php } ?>
    </tbody>
    <!-- <= \app\models\Methods::print_array($addlist);?> -->

</table>
<input type="hidden" name="hidden" value="savelists">
<button type="submit" class="btn btn-success pull-right">บันทึก</button>

