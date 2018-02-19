<?php
use yii\helpers\Html;
?>

<div class="box box-success">
    <div class="row">
        <div class="col-md-2 col-xs-12">
        <?php
            foreach($instalment as $ints){
                echo "<div>";
                echo Html::a(\app\models\Methods::getMonth($ints['instalment_monthly'])." ".
                        $ints['instalment_year']." (".$ints['instalment'].")", ['user/view', 'id' => $ints['inst_id']], 
                        ['class' => 'btn btn-info']
                    );
                echo "</div>";
            }

        ?>
        </div>
        <div class="col-md-10 col-xs-12">
            ddf
        </div>
    </div>

</div>