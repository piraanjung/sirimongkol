<style>
    .r{
        text-align:right
    }
    .l{
        text-align:left
    }
    _total{
        background:blue
    }
</style>
<?php if(count($paidbybanks) > 0){  $sum =0; ?>
    <button class="btn btn-info btn-raised pull-right" id="printbtn">Print</button>
    <br style="clear:both">
<div class="table-responsive">
    <h3>สรุปการจ่ายเงินให้ช่าง โดยโอนเงิน</h3>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ชื่อ-สกุล</th>
            <th>จำนวนเงิน</th>
        </tr>
        <?php foreach($paidbybanks as $paidbybank){ ?>
        <tr>
            <td><?=$paidbybank['name'];?></td>
            <td class="r"><?=number_format($paidbybank['paid_amount'],2);?></td>
        </tr>
        <?php $sum += $paidbybank['paid_amount']; ?>
        <?php }//foreach ?>
        <tr>
            <td colspan="2" class="_total">
                <div class="row">
                    <div class="col-md-6"><b>รวม</b></div>
                    <div class="col-md-6 r"><b><?=number_format($sum, 2);?></b></div>
                </div>
            </td>
        </tr>
    </table>
</div>
<?php } ?>