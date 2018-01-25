<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

// use app\models\Form;
// use app\models\Payee;
use app\models\Project;
use app\models\Housemodels;
use app\models\MoneyType;
use app\models\Instalment;
use app\models\Houses;
use yii\bootstrap\Alert;

$inst = $instalment['monthly']."/".$instalment['instalment'].".".$instalment['year'];
$this->title = 'จ่ายงวดงานโดยเลือกช่าง งวดที่ '.$inst;

$this->params['breadcrumbs'][] = ['label' => 'เพิ่มงวดจ่าย', 'url' => ['instalment/index']];
$this->params['breadcrumbs'][] = $this->title;

$instructor = ArrayHelper::map(\app\models\User ::find()
    ->where(['user_type_id' => 4])->all(), 'id', 'username');  

$moneyType = ArrayHelper::map(MoneyType::find()->all(), 'id', 'name');
$workClassify = ArrayHelper::map(\app\models\WorkCategory::find()
    ->select('id, wc_name')->all(), 'id', 'wc_name');
    
$houses = Arrayhelper::map(Houses::find()->all(), 'id', 'house_name');

if(Yii::$app->session->getFlash('save_res')!=""){
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info',
        ],
        'body' => Yii::$app->session->getFlash('save_res'),
    ]); 
}
?>
    <div class="box box-primary">
        <div class="box-body">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><?=$this->title;?></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">โครงการ ศิริมงคล 6</a>
                        </li>
                    </ul>

                </div>
            </nav>


            <?php $form = ActiveForm::begin(['id'=> $model->formName()]); ?>
            <div class="row">
                <div class="col-md-3 col-xs-12">

                    <?= $form->field($model, 'house_id')->dropDownList($houses,[
        'prompt' => 'เลือก...'])->label('แปลงบ้าน'); ?>
                </div>
                <div class="col-md-3 col-xs-12">
                    <?= $form->field($model, 'contructor_id')->dropDownList($instructor,[
                    'prompt' => 'เลือก...'])->label('เลือกช่าง'); ?>
                </div>
                <div class="col-md-3 col-xs-12">
                    <label class="control-label">งวดที่</label>
                    <input type="text" value="<?=$inst;?>" class="form-control" readonly="readonly">
                    <?= $form->field($model, 'instalment_id')->hiddenInput(['value' => $instalment['id']])->label(false) ?>

                </div>
                <div class="col-md-3 col-xs-12">
                    <?= $form->field($model, 'money_type_id')->dropDownList($moneyType,[
                    'prompt' => 'เลือก...'])->label('ประเภทงวดที่จ่าย'); ?>
                </div>
            </div>
            <div class="row">


            </div>

            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <?= $form->field($model, 'workclassify_id')->dropDownList($workClassify,[
                    'prompt' => 'เลือก...'])->label('หมวดงาน'); ?>
                </div>
                <div class="col-md-3 col-xs-12 form-group">
                    <label class="control-label ">กลุ่มงาน</label>
                    <select id="workgroup" name="Laborcostdetails[workgroup]" 
                        class="form-control"></select>
                </div>
                <div class="col-md-3 col-xs-12 form-group">
                    <label class="control-label ">งาน</label>
                    <select id="works" name="Laborcostdetails[works]" 
                        class="form-control"></select>
                </div>
                <div class="col-md-3 col-xs-12 form-group">
                    <label class="control-label">งบควบคุม</label>
                    <input type="text" value="" class="form-control" id="w_controlstatement" name="w_controlstatement" readonly="readonly">

                </div>


            </div>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <?= $form->field($model, 'amount')->textInput()->label('จำนวนจ่าย');?>
                </div>
                <div class="col-md-9 col-xs-12">
                <?= $form->field($model, 'comment')->textArea()->label('หมายเหตุ');?>
                </div>
            </div>
            <input type="hidden" name="hidden" value="addlists">
            <button type="submit" class="btn btn-success pull-right">เพิ่มรายการ</button>
            <br style="clear:both">
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php if((count($addlist) > 0) && ($addlist[0]['Instalmentcostdetails']['instalment_id'] == $instalment['instalment'])){ ?>
    <div class="box box-success">
        <div class="box-body">
            <div class="table-responsive">
                <?php $form = ActiveForm::begin(['id'=> $model->formName()]); ?>
                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th style="width:8%;text-align:center">แปลงบ้าน</th>
                            <th style="width:18%;text-align:center">ชื่อช่าง</th>
                            <th style="width:8%;text-align:center">งวดที่</th>
                            <th style="width:15%;text-align:center">หมวดงาน</th>
                            <th style="width:15%;text-align:center">งาน</th>
                            <th style="width:15%;text-align:center">งบควบคุม(บาท)</th>
                            <th style="width:12%;text-align:center">จำนวนจ่าย(บาท)</th>
                            <th style="width:10%;text-align:center">ประเภทงวด</th>
                            <th style="text-align:center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c=0;?>
                        <!-- <php Form::print_array($addlist);?> -->
                        <?php foreach($addlist as $ls){ ?>
                        <tr>
                        <td>
                            <?=$ls['Instalmentcostdetails']['house_id'];?>
                            <input type="hidden" name="aa[house_id][]"  
                            value="<?=$ls['Instalmentcostdetails']['house_id'];?>">
                        </td>
                            <td>

                            <?php
                            $payee = \app\models\User::find()->select('username')
                                ->where(['id' => $ls['Instalmentcostdetails']['contructor_id']])->one();
                            echo $payee['username'];
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
                                echo $work_classify_id['wc_name'];
                                ?>
                                    <input type="hidden" name="aa[workclassify_id][]" value="<?=$ls['Instalmentcostdetails']['workclassify_id'];?>">
                            </td>
                            <td>
                                <?php 
                                $worktype = \app\models\WorkGroup::find()->select('wg_name')
                                    ->where(['id'=> $ls['Laborcostdetails']['workgroup'] ])->one();
                                echo $worktype['wg_name'];
                                ?>
                                <input type="hidden" name="aa[work_type][]"  
                                    value="<?=$ls['Laborcostdetails']['workgroup'];?>">
                            </td>
                            <td>
                                <?php 
                                $worktype = \app\models\Works::find()->select('work_name')
                                    ->where(['id'=> $ls['Laborcostdetails']['workgroup'] ])->one();
                                echo $worktype['work_name'];
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
                                $money_type = MoneyType::find()->select('name')
                                    ->where(['id' => $ls['Instalmentcostdetails']['money_type_id']])->one();
                                echo $money_type['name'];
                                ?>
                                <input type="hidden" name="aa[money_type_id][]" value="<?=$ls['Instalmentcostdetails']['money_type_id'];?>">
                            </td>
                            <td style="width:20%">
                                <!-- <Html::a('แก้ไข',['form/unset-array', 'id'=>0], ['class'=>'btn btn-default btn-md btn-raised']);?> -->
                                <?= Html::a('ลบ',['unset-array', 'id'=>$c++, 'instalment_id' => $ls['Instalmentcostdetails']['instalment_id']], 
                                        ['class'=>'btn btn-danger btn-md btn-raised']);?>
                            </td>
                            <!-- <"<pre>";print_r($ls);?> -->

                        </tr>
                        <?php } ?>
                    </tbody>


                </table>
                <input type="hidden" name="hidden" value="savelists">
                <button type="submit" class="btn btn-success pull-right">บันทึก</button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <?php } ?>



    <?php
$script = <<< JS


    $('#instalmentcostdetails-workclassify_id').change(function(){
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=work-group/work-group-lists&wc_id='+$(this).val(),
           // data : {id: $(this).val()},
            success : function(data){
                $( "#workgroup" ).html( data );
            }

        })
    });
    $('#workgroup').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-lists&wg_id='+$(this).val(),
           // data : {id: $(this).val()},
            success : function(data){
                $( "#works" ).html( data );
            }

        })
    });

    $('#works').change(function(){
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=works/get-work-control-statement&w_id='+$(this).val(),
               success : function(data){
                $( "#w_controlstatement" ).val( data );
            }

        })
    });


    $('#paid_amount_id').keyup(function(){
        var checkzero = $(this).val();
        if(checkzero == "0"){
            $(this).val("");
        }
    })

JS;
$this->registerJs($script);
?>