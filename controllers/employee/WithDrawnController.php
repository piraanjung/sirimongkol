<?php

namespace app\controllers\employee;
use Yii;
use app\models\Laborcostdetails;
use yii\db\Query;
 
class WithDrawnController extends \yii\web\Controller
{
    public function actionIndex($instalment_id)
    {
        $this->layout = "employee_layout";
        $query = new Query;
        // compose the query
        $query->select('*')
            ->from('instalmentcostdetails')
            ->where(['instalment_id'=> $instalment_id])
            ->andWhere(['summoney_id' => 0])
            ->orderBy('money_type_id,contructor_id', 'asc')
            ->groupBy('id');
        $command = $query->createCommand();
        $rows = $command->queryAll();
        $inst = \app\models\Instalment::find()->where(['id' => $instalment_id])->one();
        $inst_date = explode(" ", $inst['create_date']);
        $date = explode("-",$inst_date[0]);
        $monththai = \app\models\Methods::getMonth($date[1]);
        $yearthai = "25".$inst['year'];
        $inst_str = $date[2]." ".$monththai." ".$yearthai." (".$inst['monthly']."/".$inst['instalment'].".".$inst['year'] .")";
        // \app\models\Methods::print_array($inst_date);
        // 
        return $this->render('index',[
            'models' => $rows,
            'inst_str' => $inst_str
        ]);
    }

    public function actionCreate(){
        $this->layout = "employee_layout";
        if(count(Yii::$app->request->post()) >0){
            $this->sumAmountByInstalment($_REQUEST['_instalment_id']);

            foreach($_REQUEST['paidmethod'] as  $key => $pm ){
                foreach($pm as $k => $val){
                    if($k =='cash' || $k =='bank'){
                        if($val !=""){
                            $model =  new \app\models\Paidtype();
                            $model->paid_amount = $val;
                            $model->paid_type   = $k == "cash" ? 1 : 2;
                            $model->summoney_id = $this->getSummoneyId($_REQUEST['_instalment_id'], $key);
                            $model->create_date = date('Y-m-d H:i:s');
                            $model->update_date = date('Y-m-d H:i:s');
                            $model->save();
                        }
                    }
                }
            }
        }
        return $this->redirect(['employee/instalment/index']);
    }

    public function sumAmountByInstalment($inst_id){
        $query = new Query;
        // compose the query
        $query->select('sum(amount)as total, contructor_id, instalment_id')
            ->from('instalmentcostdetails')
            ->where(['instalment_id'=> $inst_id])
            ->andWhere(['summoney_id' => 0])
            ->groupBy('contructor_id');
        // build and execute the query
        $rows = $query->all();
        // alternatively, you can create DB command and execute it
        $command = $query->createCommand();
        // $command->sql returns the actual SQL
        $rows = $command->queryAll();

        foreach($rows as $row){
            $summoney = new \app\models\Summoney();
            $summoney->total            = $row['total'];
            $summoney->contructor_id    = $row['contructor_id'];
            $summoney->instalment_id    = $row['instalment_id'];
            $summoney->create_date      = date('y-m-d H:i:s');
            $summoney->update_date      = date('y-m-d H:i:s');
            if($summoney->save()){
                // update summoney_id ใน instalmentcostdetails table รายช่าง
                $update_query = \Yii::$app->db;
                $command = $update_query->createCommand('UPDATE instalmentcostdetails SET summoney_id='.$summoney->id.'  
                                 WHERE contructor_id ='. $summoney->contructor_id .' 
                                 AND instalment_id = '. $summoney->instalment_id);
                $command->execute();
            }
        }
    }

    private function getSummoneyId($inst_id, $const_id){
        $constructor_id = \app\models\Summoney::find()
                        ->select('id')
                        ->where(['instalment_id' => $inst_id])
                        ->andWhere(['contructor_id' => $const_id])
                        ->one(); 
        return $constructor_id['id'];
    }

}
