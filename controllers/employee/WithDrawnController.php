<?php

namespace app\controllers\employee;
use Yii;
use app\models\Laborcostdetails;
use yii\db\Query;
 
class WithDrawnController extends \yii\web\Controller
{
    public function actionIndex($instalment_id)
    {
        $query = new Query;
        // compose the query
        $query->select('*')
            ->from('instalmentcostdetails')
            ->where(['instalment_id'=> $instalment_id])
            ->andWhere(['summoney_id' => 0])
            ->orderBy('contructor_id', 'asc')
            ->groupBy('id');
        $command = $query->createCommand();
        $rows = $command->queryAll();
        return $this->render('index',[
            'models' => $rows
        ]);
    }

    public function actionCreate(){
        if(count(Yii::$app->request->post()) >0){
            // \app\models\Form::print_array($_REQUEST['paidmethod']);
            foreach($_REQUEST['paidmethod'] as  $key => $pm ){
                foreach($pm as $k => $val){
                    if($k =='cash' || $k =='bank'){
                        if($val !=""){
                            $model =  new \app\models\Paidtype();
                            $model->paid_amount = $val;
                            $model->paid_type   = $k == "cash" ? 1 : 2;
                            $model->summoney_id = $pm['summoney_id'];
                            $model->create_date = date('Y-m-d H:i:s');
                            $model->update_date = date('Y-m-d H:i:s');
                            $model->save();
                        }
                    }
                }
            }
             
        }
        return $this->redirect(['instalment/index']);
        // \app\models\Form::print_array($_REQUEST);
    }

}
