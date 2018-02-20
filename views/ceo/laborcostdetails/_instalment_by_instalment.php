<?php
use yii\helpers\Html;
?>

<div class="box box-success">
    <div class="row">
        <div class="col-md-2 col-xs-12">
        
        <?php
            foreach($instalment as $ints){
                $text= \app\models\Methods::getMonth($ints['instalment_monthly'])." ".
                        $ints['instalment_year']." (".$ints['instalment'].")";
                echo Html::button($text, [ 'class' => 'btn btn-primary _inst btn-block', 
                    'value' => $ints['inst_id'], 'id' => 'inst'.$ints['instalment']]);
            }

        ?>
        </div>
        <div class="col-md-10 col-xs-12">
            <div id="show">nn</div>
        </div>
    </div>

</div>
<?php
// Form::print_array($models);
$this->registerJs("
    $('._inst').click(function(){
        inst_id = $(this).attr('value');
        $.ajax({
            type : 'GET',
            url  : 'index.php?r=ceo/laborcostdetails/get-data-by-instalement&id='+$(this).val(),
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


