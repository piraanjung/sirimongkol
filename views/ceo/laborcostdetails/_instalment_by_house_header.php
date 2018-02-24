<style>
    .info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 50px !important;
    text-align: center;
    font-size: 30px;
    line-height: 90px;
    background: rgba(0, 0, 0, 0.2);
    }
    .info-box-content {
    padding: 5px 10px;
    margin-left: 45px !important;
}
</style>

<?php if(count($instalment)> 0){  
    $percent = ($instalment[0]['sum_amount']/$instalment[0]['hm_control_statment'])*100    
?>
    <div class="box box-success ">
        <div class="row">
            <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-map-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">แบบบ้าน :</span>
                <span class="info-box-number"> <?=$instalment[0]['hm_name']; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">แปลงบ้าน</span>
                <span class="info-box-number"><?=$instalment[0]['house_name'];?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box <?=$percent > 100 ?' bg-yellow' : '' ?>">
                    <span class="info-box-icon <?=$percent > 100 ?' bg-yellow' : 'bg-green' ?>">
                        <i class="fa  fa-line-chart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">งบควบคุม</span>
                    <span class="info-box-number"><?=number_format($instalment[0]['hm_control_statment'],2);?><small> บาท</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box <?=$percent > 100 ?' bg-yellow' : '' ?>">
                    <span class="info-box-icon <?=$percent > 100 ?' bg-yellow' : 'bg-green' ?>">
                        <i class="fa  fa-line-chart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">จ่ายแล้ว</span>
                    <span class="info-box-number"><?=number_format($instalment[0]['sum_amount'],2);?><small> บาท</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-2 col-sm-6 col-xs-12">
                <div class="info-box <?=$percent > 100 ?' bg-yellow' : '' ?>">
                    <span class="info-box-icon <?=$percent > 100 ?' bg-yellow' : 'bg-green' ?>">
                        <i class="fa  fa-line-chart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">% การก่อสร้าง</span>
                    <span class="info-box-number"><?=number_format($percent,2);?><small>%</small></span>
                    <span class="info-box-text"><?=$percent > 100 ?'เกินงบควบคุม' : 'ปกติ' ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->


        </div>
    </div>
<?php } ?>