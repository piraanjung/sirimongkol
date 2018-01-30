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

$instructor = ArrayHelper::map(\app\models\Profile ::find()
    ->leftJoin('user', 'user.id = profile.user_id')
    ->where(['user.user_type_id' => 4])->all(), 'user_id', 'name');  

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
    <div class="box box-success">
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
                    <?= $form->field($model, 'contructor_id')->dropDownList($instructor,[
                    'prompt' => 'เลือก...'])->label('เลือกช่าง'); ?>
                </div>
                <div class="col-md-3 col-xs-12">
                    <label class="control-label">ประเภทการจ่ายเงิน</label>
                   <select name="paid_type" id="paid_type" class="form-control">
                        <option>เลือก...</option>
                        <option value="1" selected>จ่ายเงินงวดตามชนิดงาน</option>
                        <option value="2">หักค่า กู้ยืมเงิน/เครื่องมือ</option>
                   </select>
                </div>
            </div>


            <div class="tab-content">
                <div class="tab-pane active" id="activity">
                    <h2>จ่ายงวดตามชนิดงาน</h2>
                    <?=$this->render('_paid_by_house_form',[
                        'form' =>$form,
                        'model' => $model,
                        'houses' =>$houses,
                        'inst' => $inst,
                        'instalment' => $instalment,
                        'moneyType' =>$moneyType,
                        'workClassify' => $workClassify
                    ]);?>
                </div>
                <div class="tab-pane" id="timeline" style="display:none">
                    <h2>หัก ค่ากู้ยืม/ค่าเครื่องมือ</h2>
                    <?= $this->render('_loan_deduction_form',[
                        'form' =>$form,
                        'model' => $model,
                        'houses' =>$houses,
                        'instalment' => $instalment,
                    ]);?>
                </div>
            </div>
            
            <input type="hidden" name="hidden" value="addlists">
            <button type="submit" class="btn btn-success pull-right">เพิ่มรายการ</button>
            <br style="clear:both">
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php if(count($addlist) > 0 && 
                $addlist[0]['Instalmentcostdetails']['instalment_id'] == $instalment['id']){ ?>
       
       <div class="box box-success">
            <div class="box-body">
                <div class="table-responsive">
                    <?php $form = ActiveForm::begin(['id'=> $model->formName()]); ?>
                        <?= $this->render('_instalment_paid_lists',[
                                            'addlist' => $addlist,
                                            'instalment' => $instalment,
                                            'form' => $form
                            ]);    
                        ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php
$script = <<< JS


    $('#instalmentcostdetails-workclassify_id').change(function(){
        console.log($(this).val())
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

    $( document ).ready(function() {
        $("#timeline input").prop("disabled", true);
    });

    $('#paid_type').change(function(){
        console.log($(this).val())
        if($(this).val() == 1){
            $("#activity input").prop("disabled", false);
            $("#activity select").prop("disabled", false);
            $("#activity textarea").prop("disabled", false);
            $("#activity").attr("style", "display:block");
            $("#timeline").attr("style", "display:none");
            $("#timeline input").prop("disabled", true);
        }else if($(this).val() == 2){
            $("#timeline input").prop("disabled", false);
            $("#activity input").prop("disabled", true);
            $("#activity select").prop("disabled", true);
            $("#activity textarea").prop("disabled", true);
            $("#activity").attr("style", "display:none");
            $("#timeline").attr("style", "display:block");
        }
    })

JS;
$this->registerJs($script);
?>