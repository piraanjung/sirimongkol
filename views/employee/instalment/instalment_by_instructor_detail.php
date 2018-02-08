<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use app\models\Form;
use yii\widgets\ActiveForm;

$this->title = 'สรุปข้อมูลการจ่ายงวด';
$this->params['breadcrumbs'][] = ['label' => 'งวดจ่ายเงิน', 'url' => ['instalment/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

</style>
<div class="box box-success" >
<div class="box-body">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">ผู้รับเหมา</a></li>
    <li class="dropdown">
    <a class="dropdown-toggle contructor-menu" data-toggle="dropdown" href="#">สรุปการจ่ายเงินให้ช่าง
        <span class="caret"></span>
    </a>
    <ul class="contructor-ul dropdown-menu">
        <li><a data-toggle="tab" href="#paid_by_cash">- จ่ายเงินสด</a></li>
        <li><a data-toggle="tab" href="#paid_by_bank">- โอนเงินผ่านธนาคาร</a></li>
    </ul>
    </li>
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">สรุปการโอนเงินแต่ละธนาคาร
    <span class="caret"></span>        </a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_bkb">- ธนาคารกรุงเทพ</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_ktb">- ธนาคารกรุงไทย</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_kb">- ธนาคารกสิกรไทย</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_scb">- ธนาคารไทยพาณิชย์</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_tmb">- ธนาคารทหารไทย</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_gsb">- ธนาคารออมสิน</a></li>
                <li><a data-toggle="tab" href="#transfer_divide_by_bank_ksb">- ธนาคารกรุงศรีอยุธยา</a></li>
            </ul>

    </li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <!-- <h3>ตั้งเบิก</h3> -->
      <?=$this->render("test.php",[
            'models' => $models
        ]);?>
    </div>
    <div id="paid_by_cash" class="tab-pane fade">
        <!-- <h3>สรุปการจ่ายเงินให้ช่าง โดยจ่ายเงินสด</h3> -->
        <?=$this->render("paidbycash.php",[
            'paidbycashs' => $paidbycash
        ]);?>
    </div>
    <div id="paid_by_bank" class="tab-pane fade">
        <!-- <h3>สรุปการจ่ายเงินให้ช่าง โดยโอนเงิน</h3> -->
        <?=$this->render("paidbybank.php",[
            'paidbybanks' => $paidbybanks
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_bkb" class="tab-pane fade">
      <h3>ธนาคารกรุงเทพ</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $bkb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_ktb" class="tab-pane fade">
      <h3>ธนาคารกรุงไทย</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $ktb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_kb" class="tab-pane fade">
      <h3>ธนาคารกสิกรไทย</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $kb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_scb" class="tab-pane fade">
      <h3>ธนาคารไทยพาณิชย์</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $scb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_tmb" class="tab-pane fade">
      <h3>ธนาคารทหารไทย</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $tmb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_gsb" class="tab-pane fade">
      <h3>ธนาคารออมสิน</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $gsb
        ]);?>
    </div>
    <div id="transfer_divide_by_bank_ksb" class="tab-pane fade">
      <h3>ธนาคารกรุงศรีอยุธยา</h3>
      <?=$this->render("banksummary.php",[
            'bank' => $ksb
        ]);?>
    </div>
  </div>




  </div>
</div> <!-- well -->
<?php
// Form::print_array($models);
$this->registerJs("
    $('.paymethod').click(function(){
        id = $(this).attr('id')

        $('#paymethod'+id).toggle('fadein')
    })

    $('#printbtn').click(function(){
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    })




    
", $this::POS_READY); 
?>

