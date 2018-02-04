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
                    <?= $form->field($model, 'money_type_id')->dropDownList($moneyType,[
                        'prompt' => 'เลือก...'])->label('ประเภทงวดที่จ่าย'); ?>
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
                <div id="loan_div">
                    <div class="col-md-6 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">หัก เงินกู้ยืม</h3>
                            </div>
                            <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12- col-md-6">
                                <input type="text" name="deduction[loan_deduction][amount]" 
                                        id="loan_deduction_money" class="form-control">
                                </div>
                                <input type="hidden" name="deduction[loan_deduction][type]" value="3">
                            </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>

                <div id="equipment_div">
                    <div class="col-md-6 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">หัก ค่าเครื่องมือ</h3>
                            </div>
                            <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                <input type="text" name="deduction[equipment_deduction][amount]" 
                                        id="equipment_deduction_money" class="form-control">
                                
                                <input type="hidden" name="deduction[equipment_deduction][type]" value="4">
                                </div>
                            </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
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
        
        $("#loan_div").css("display", "none");
        $("#loan_div input").prop("disabled", true);

        $("#equipment_div").css("display", "none");
        $("#equipment_div input").prop("disabled", true);
        $('#instalmentcostdetails-workclassify_id').val("");
    });



    $('#instalmentcostdetails-money_type_id').change(function(){
        var _type = $(this).val()
        if(_type == 1 || _type ==2){
            $("#activity").css("display", "block");
            $("#activity input").prop("disabled", false);
            $("#activity select").prop("disabled", false);
            $("#activity textarea").prop("disabled", false);
            $('#activity select#instalmentcostdetails-house_id option[value="0"]').remove()
            $('#activity select#instalmentcostdetails-workclassify_id option[value="0"]').remove()
            $('#activity select#workgroup option[value="0"]').remove()
            $('#activity select#works option[value="0"]').remove()
            
            $("#loan_div").css("display", "none");
            $("#loan_div input").prop("disabled", true);

            $("#equipment_div").css("display", "none");
            $("#equipment_div input").prop("disabled", true);
            
        }else{
            if(_type == 3){
                //จ่ายค่ากู้ยืม
                $("#loan_div").css("display", "block");
                $("#loan_div input").prop("disabled", false);

                $("#equipment_div").css("display", "none");
                $("#equipment_div input").prop("disabled", true);
            
            }else if(_type == 4){
                //equipment_div
                $("#equipment_div").css("display", "block");
                $("#equipment_div input").prop("disabled", false);
                $("#loan_div").css("display", "none");
                $("#loan_div input").prop("disabled", true);
            }
            $('#activity').css("display", "none")
            // $("#activity input").prop("disabled", true);
            // $("#activity select").prop("disabled", true);
            // $("#activity textarea").prop("disabled", true);
            $('#activity select#instalmentcostdetails-house_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-house_id').val(0)
            
            $('#activity select#instalmentcostdetails-workclassify_id').append("<option value='0'>0</option>")
            $('#activity select#instalmentcostdetails-workclassify_id').val(0)
            
            $('#activity select#workgroup').append("<option value='0'>0</option>")
            $('#activity select#workgroup').val(0)
            
            $('#activity select#works').append("<option value='0'>0</option>")
            $('#activity select#works').val(0)
            
            $('#w_controlstatement').val(0)
            $('#instalmentcostdetails-amount').val(0)
            
        }//else
    });

    $('#instalmentcostdetails-amount').change(function(){
        console.log($(this).val())
    });

JS;
$this->registerJs($script);
?>