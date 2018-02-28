<?php

use yii\helpers\Html;
echo "<pre>";
print_r($instalment);die();
?>
<div class="box box-success">
    <div class="row">
        <div class="col-md-2 col-xs-12">
        
        <?php
            foreach($instalment as $ints){
                $text= \app\models\Methods::getMonth($ints['instalment_monthly'])." ".
                        $ints['instalment_year']." (".$ints['instalment'].")";
                echo Html::button($text, [ 'class' => 'btn btn-primary _inst btn-block', 
                    'value' => $ints['inst_id'], 'id' => 'inst'.$ints['instalment'],'house_id' => $ints['house_id']]);
            }

        ?>
        </div>
        <div class="col-md-10 col-xs-12">
            <div id="show"></div>
        </div>
    </div>

</div>
<?php
// Form::print_array($models);
$this->registerJs("
    $('._inst').click(function(){
        inst_id = $(this).attr('value');
        house_id = $(this).attr('house_id')
        $.ajax({
            type : 'POST',
            data : {id : inst_id, house_id : house_id},
            url  : 'index.php?r=ceo/laborcostdetails/get-data-by-instalement',
            success : function(data){
                console.log(data)
                var t='';
                t+= '<div class=\"row\">';
                for(i=0; i<2; i++){
                    t+='<div class=\"col-md-3\">dfdff</div>';
                    t+='<div class=\"col-md-3\">wwwww</div>';
                }
                t+= '</div>';
                $('#show').html(data)
            }

        })
    })
", $this::POS_READY); 
?>


