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
    
$houses = Arrayhelper::map(Houses::find()->all(), 'id', 'house_id');

if(Yii::$app->session->getFlash('save_res')!=""){
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info',
        ],
        'body' => Yii::$app->session->getFlash('save_res'),
    ]); 
}
?>
    <div class="well">
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
                <label class="control-label ">ชนิดงาน</label>
                <select id="workname" name="Laborcostdetails[work_type]" 
                    class="form-control"></select>
            </div>
            <div class="col-md-3 col-xs-12">
                <label class="control-label">งบควบคุม</label>
                <input type="text" value="<?=$inst;?>" class="form-control" readonly="readonly">

            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'amount')->textInput()->label('จำนวนจ่าย');?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
            <?= $form->field($model, 'comment')->textArea()->label('หมายเหตุ');?>
            </div>
        </div>
        <input type="hidden" name="hidden" value="addlists">
        <button type="submit" class="btn btn-raised">เพิ่มรายการ</button>

        <?php ActiveForm::end(); ?>
    </div>

    <?php if(count($addlist)>0){ ?>
    <div class="well">
        <div class="table-responsive">
            <?php $form = ActiveForm::begin(['id'=> $model->formName()]); ?>
            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                    <th style="width:20%;text-align:center">แปลงบ้าน</th>
                        <th style="width:20%;text-align:center">ชื่อช่าง</th>
                        <th style="text-align:center">งวดที่</th>
                        <th style="text-align:center">หมวดงาน</th>
                        <th style="text-align:center">งาน</th>
                        <th style="text-align:center">งบควบคุม(บาท)</th>
                        <th style="text-align:center">จำนวนจ่าย(บาท)</th>
                        <th style="text-align:center">ประเภทงวด</th>
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
                        $payee = Payee::find()->select('name')
                            ->where(['id' => $ls['Instalmentcostdetails']['contructor_id']])->one();
                        echo $payee['name'];
                        ?>
                                <input type="hidden" name="aa[contructor_id][]" value="<?=$ls['Instalmentcostdetails']['contructor_id'];?>">
                        </td>
                        <td>
                        <?php
                            $instalment_no = Form::find()->select('instalment_no')
                                ->where(['id' => $ls['Instalmentcostdetails']['instalment_id']])->one();
                            echo $instalment_no['instalment_no'];
                        ?>
                            <input type="hidden" name="aa[instalment_id][]" value="<?=$ls['Instalmentcostdetails']['instalment_id'];?>">
                        </td>
                        <td>
                            <?php
                            $work_classify_id = \app\models\WorkClassify::find()->select('wc_name')
                                ->where(['id' => $ls['Instalmentcostdetails']['workclassify_id']])->one();
                            echo $work_classify_id['wc_name'];
                            ?>
                                <input type="hidden" name="aa[workclassify_id][]" value="<?=$ls['Instalmentcostdetails']['workclassify_id'];?>">
                        </td>
                        <td>
                            <?php 
                            $worktype = \app\models\WorkType::find()->select('work_type_name')
                                ->where(['id'=> $ls['Laborcostdetails']['work_type'] ])->one();
                            echo $worktype['work_type_name'];
                            ?>
                            <input type="hidden" name="aa[work_type][]"  
                                value="<?=$ls['Laborcostdetails']['work_type'];?>">
                        </td>
                        <td style="text-align:right">
                            <?=number_format($ls['Instalmentcostdetails']['ceiling_money'],2);?>
                                <input type="hidden" name="aa[ceiling_money][]" value="<?=$ls['Instalmentcostdetails']['ceiling_money'];?>">
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
                            <?= Html::a('ลบ',['unset-array', 'id'=>$c++], ['class'=>'btn btn-danger btn-md btn-raised']);?>
                        </td>
                        <!-- <"<pre>";print_r($ls);?> -->

                    </tr>
                    <?php } ?>
                </tbody>


            </table>
            <input type="hidden" name="hidden" value="savelists">
            <button type="submit" class="btn btn-raised">บันทึก</button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php } ?>



    <?php
$script = <<< JS


    $('#instalmentcostdetails-workclassify_id').change(function(){
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=work-type/worklists&id='+$(this).val(),
           // data : {id: $(this).val()},
            success : function(data){
                $( "#workname" ).html( data );
            }

        })
    });
    $('#workname').change(function(){
        console.log($(this).val())
        $.ajax({
            type : 'POST',
            url  : 'index.php?r=work-type/get-worktype-costs&id='+$(this).val(),
           // data : {id: $(this).val()},
            success : function(data){
                $( "#instalmentcostdetails-ceiling_money" ).val( data );
                // console.log(data)
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