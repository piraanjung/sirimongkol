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
<style>
.payee_sum{
    background:#43B2F7;
    color:#FFFFFF 
}
._total{
    background:blue;
    color:#FFFFFF;
    text-align:right;
}
._number{
    text-align:right
}
.paidmethod{
    color:#000000;
    text-align:right;
    font-weight:bold
}
</style>
<div class="box box-success">
<div class="box-body">
<?php if(count($models) >0){ ?>
<?php $form = ActiveForm::begin(['action' => ['employee/with-drawn/create'],'options' => ['method' => 'post']]) ?>
    <p>
    ตั้งเบิก  ค่าใช้จ่ายประจำวันที่  30 พฤศจิกายน 2560 (งวด 11/2.60)
    </p>
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
            $sum_id= $models[0]['summoney_id'];
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
                    $total+=$sum_by_User;
                    $sum_by_User =0;
                    $showname =1;
                ?>
                <tr>
                <td><?=++$i?></td>
                <td>
                <?php 
                    $User = app\models\User::find()
                        ->where(['id'=>$model['contructor_id']])->one();
                        if($showname ==1){
                            echo $User['name'];
                            $showname =0;
                        }
                ?>
                </td>   
                <td><?=$model['house_id']?></td>
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
                        $user = app\models\user::find()
                            ->where(['id'=>$model['contructor_id']])->one();
                            if($showname ==1){
                                echo $user['username'];
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
        <?= Html::submitButton('บันทึก' , ['class' => 'btn btn-success btn-raised' ]) ?>
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