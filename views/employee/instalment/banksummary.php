
<?php if(count($bank) > 0){ $_total=0;?>
    <button class="btn btn-info btn-raised pull-right" id="printbtn">Print</button>
    <br style="clear:both">
    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>ชื่อ - สกุล</th>
                <th>หมายเลขบัญชี</th>
                <th>จำนวนเงิน</th>
            </tr>
            <?php foreach($bank as $key =>  $b){ ?>
            <tr>
                <td><?=++$key;?></td>
                <td><?=$b['bank'];?></td>
                <td><?=$b['account_bank'];?></td>
                <td class="_number"><?=number_format($b['paid_amount'],2); $_total+=$b['paid_amount'];?></td>
            </tr>
                
            <?php }//foreach ?>
            <tr class="_total">
                <td colspan="3">รวม</td>
                <td class="_number"><?=number_format($_total, 2);?></td>
            </tr>
        </table>
    </div>
<?php }else{ ?>
        <h2 style="text-align:center">ไม่พบข้อมูล</h2>
<?php }//else ?>


