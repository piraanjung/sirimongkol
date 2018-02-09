<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box bg-aqua">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content bg-aqua">
              <h3>สิริมงคล  <?=substr($houseCount[0]['project_id'],-1);?></h3>
              <h5><?=$project['start_date'];?> - <?=$project['end_date'];?></h5>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">งบก่อสร้าง</span>
              <span class="info-box-number"><?=number_format($project['control_statement'],2);?></span> บาท
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">จ่ายแล้ว</span>
              <span class="info-box-number"><?=number_format($sumPaidAmountByProject,2);?></span> บาท
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-fw fa-pie-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">จ่ายแล้ว : งบก่อสร้าง</span>
                <span class="info-box-number">
                  <?=number_format(($sumPaidAmountByProject*100)/$project['control_statement'],2);?> %
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>


      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">จำนวนบ้าน</span>
                <span class="info-box-number"><?=count($houseCount);?></span> หลัง
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-default"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">ยังไม่ดำเนินการ</span>
                <span class="info-box-number">
                    <?=count($houseCount)-($completeBuildedHoueses+$duringBuildedHouses);?>
                </span> หลัง
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">บ้านแล้วเสร็จ</span>
              <span class="info-box-number"><?=$completeBuildedHoueses;?></span> หลัง
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">กำลังก่อสร้าง</span>
              <span class="info-box-number"><?=$duringBuildedHouses;?></span> หลัง
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>