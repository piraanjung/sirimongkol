<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\Form;
use yii\widgets\ActiveForm;
$this->title = 'วิธีจ่ายงวด';
$this->params['breadcrumbs'][] = ['label' => 'จ่ายงวด', 'url' => ['instalment/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>วิธีการจ่ายเงินให้ช่าง</h1>

<div class="box box-success">
<div class="box-body">
<?php if(count($models) >0){ ?>
<?php $form = ActiveForm::begin(['action' => ['employee/with-drawn/create'],'options' => ['method' => 'post']]) ?>
    <h3>
        ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  <?=$inst_str;?>
    </h3>
    <div class="tabel table-responsive">
        <table class="table table-condensed table-bordered">
            <thead >
                <tr  id="tr_paid_list">
                    <th>ลำดับ</th>
                    <th>ชื่อช่าง</th>   
                    <th>เลขแปลงบ้าน</th>
                    <th>รายละเอียดงาน</th>
                    <th>ลักษณะเงิน</th>
                    <th>งบควบคุม</th>
                    <th>จำนวนเงิน</th>
                    <th>หมายเหตุ</th>
                </tr>
                
            </thead>
            <tbody>
            <?php 
            $curname = $models[0]['contructor_id'];
            $sum_id= $models[0]['summoney_id'];
            $sum_by_payee=0;
            $i=0;
            $showname = 1;
            $total =0;
            // \app\models\Methods::print_array($models);
            foreach($models as $model){
                if($curname != $model['contructor_id']  ){
                    echo "<tr class='payee_sum'>";
                    echo    "<td colspan='6'> รวม</td>";
                    echo    "<td class='_number'>".number_format($sum_by_payee,2)."</td>";
                    echo    "<td>
                                <div style='color:#ffffff' class='paymethod' id='".$i."'>
                                    <span class='glyphicon glyphicon-download'></span> 
                                    วิธีจ่ายเงิน
                                </div>
                    
                            </td>";
                    echo "</tr>";
                    echo "<tr id='paymethod".$i."'   class='payee_sum'>
                            <td colspan='4'>
                                จ่ายเงินสด
                                <input type='text' class='paidmethod' name='paidmethod[".$curname."][cash]'>
                                บาท
                            </td>
                            <td colspan='4'>
                            โอนเงินทางธนาคาร
                            <input type='text' class='paidmethod' name='paidmethod[".$curname."][bank]'>
                            บาท
                            <input type='hidden' name='paidmethod[".$curname."][summoney_id]' value='".$sum_id."'>

                            </td>
                          </tr>
                          ";
                    $curname = $model['contructor_id'];
                    $sum_id= $model['summoney_id'];
                    if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                        $total-=$sum_by_payee;
                    }else{
                        $total+=$sum_by_payee;
                    }
                    $sum_by_payee =0;
                    $showname =1;
                ?>
                <tr>
                <td><?=++$i?></td>
                <td>
                <?php 
                    $User = app\models\Profile::find()
                        ->where(['user_id'=>$model['contructor_id']])->one();
                        if($showname ==1){
                            echo $User['name'];
                            $showname =0;
                        }
                ?>
                </td>   
                <td><?php
                        if($model['house_id']== 0 ){
                            echo  " ";
                        }else{
                            $house = \app\models\Houses::find()->select('house_name')
                                ->where(['id'=>$model['house_id']])->one();
                            echo $house['house_name'];
                        }
                    ?>
                </td>
                <td class="work_despt">
                <?php 
                    $work = \app\models\Works::find()->select('work_name, work_control_statement')
                        ->where(['id'=>$model['work_id']])->one();
                    echo $work['work_name'];
                ?>
                </td>
                <td>
                <?php 
                    $mt = \app\models\MoneyType::find()
                        ->where(['id'=>$model['money_type_id']])->one();
                    echo $mt['name'];
                ?>
                </td>
                <td class="_number">
                    <?= $work['work_control_statement'];?>
                </td>
                <td class="_number">
                <?php 
                    echo number_format($model['amount'],2);
                    if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                        $sum_by_payee -= $model['amount'];
                    }else{
                        $sum_by_payee += $model['amount'];
                    }
                    
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
                        $user = app\models\Profile::find()
                            ->where(['user_id'=>$model['contructor_id']])->one();
                            if($showname ==1){
                                echo $user['name'];
                                $showname =0;
                            }
                    ?>
                    </td>   
                    <td>
                        <?php
                            if($model['house_id']== 0 ){
                                echo  " ";
                            }else{
                                $house = \app\models\Houses::find()->select('house_name')
                                    ->where(['id'=>$model['house_id']])->one();
                                echo $house['house_name'];
                            }
                        ?>
                    </td>
                    <td class="work_despt">
                    <?php 
                        $work = \app\models\Works::find()->select('work_name, work_control_statement')
                        ->where(['id'=>$model['work_id']])->one();
                        echo $work['work_name'];
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
                        <?= $work['work_control_statement'];?>
                    </td>
                    <td class="_number">
                    <?php 
                        echo number_format($model['amount'],2);
                        if($model['money_type_id'] == 3 || $model['money_type_id'] ==4){
                            $sum_by_payee -= $model['amount'];
                        }else{
                            $sum_by_payee += $model['amount'];
                        }
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
                                <div style='color:#ffffff' class='paymethod' id='".$i."'>
                                    <span class='glyphicon glyphicon-download'></span> 
                                    วิธีจ่ายเงิน
                                </div>
                    
                            </td>";
                    echo "</tr>";
                    echo "<tr id='paymethod".$i."'   class='payee_sum'>
                            <td colspan='4'>
                                จ่ายเงินสด
                                <input type='text' class='paidmethod' name='paidmethod[".$curname."][cash]'>
                                บาท
                            </td>
                            <td colspan='4'>
                            โอนเงินทางธนาคาร
                            <input type='text' class='paidmethod' name='paidmethod[".$curname."][bank]'>
                            บาท
                            <input type='hidden' name='paidmethod[".$curname."][summoney_id]' value='".$sum_id."'>
                            </td>
                          </tr>
                          ";
                    $total+=$sum_by_payee;
                    $sum_by_payee  =0;
                    // $sum_id= $model['summoney_id'];
                   // $curname = $model['contructor_id'];
                 }else{
                    // echo $i ."==". count($models);
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
    <!-- <Html::a('บันทึก', ['create'], ['class' => 'btn  btn-success btn-raised']);?> -->
    <input type="hidden" name="_instalment_id" value="<?=$models[0]['instalment_id']?>">
    <div class="form-group">
        <?= Html::submitButton('บันทึก' , ['class' => 'btn btn-success pull-right' ]) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

    <?php }else{//if?>
        <h2 style='text-align:center'>ไม่พบข้อมูล</h2>
    <?php } ?>
    </div>
</div>
<?php
// Form::print_array($models);
$this->registerJs("
    $('.paymethod').click(function(){
        id = $(this).attr('id')

        $('#paymethod'+id).toggle('fadein')
    })
    
", $this::POS_READY); 
?>