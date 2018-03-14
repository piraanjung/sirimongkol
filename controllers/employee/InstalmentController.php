<?php

namespace app\controllers\employee;

use Yii;
use app\models\Instalment;
use app\models\InstalmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Project;
use app\models\Housemodels;
use app\models\WorkType;
use app\models\WorkClassify;
use app\models\Laborcostdetails;
use yii\db\Query;


/**
 * InstalmentController implements the CRUD actions for Instalment model.
 */
class InstalmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Instalment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "employee_layout";
        $searchModel = new InstalmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Instalment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Instalment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "employee_layout";
        $model = new Instalment();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->instalment  = "".$_REQUEST['Instalment']['instalment'];
            $model->monthly     = $_REQUEST['Instalment']['monthly'];
            $model->year        = substr($_REQUEST['Instalment']['year'],2);
            $model->project_id  = $_REQUEST['Instalment']['project_id'];
            $model->editor_id   = isset(Yii::$app->user->identity->id) ? "".Yii::$app->user->identity->id :"0";
            $model->create_date = date("Y-m-d H:i:s");
            $model->update_date = date("Y-m-d H:i:s");
            $model->save();
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);

        } else {
            $form = new \app\models\Methods();
            $monthly = $form->getMonthLists();
            $model->year = date("Y")+543;
            return $this->render('create', [
                'model' => $model,
                'monthly' =>$monthly
            ]);
        }
    }

    /**
     * Updates an existing Instalment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = "employee_layout";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Instalment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInstalment_by_instructor(){
        // \app\models\Methods::print_array($addlist);

        $this->layout = "employee_layout";
        $model = new \app\models\Instalmentcostdetails ;
        if(isset($_REQUEST['instalment_id'])){
            $instalment = Instalment::find()
                        ->where(['id' => $_REQUEST['instalment_id']])->one();
        }

        $session = Yii::$app->session;
        // unset($_SESSION['laborcostlist']);
        // \app\models\Methods::print_array($_SESSION['laborcostlist']); 
        if (!$session->has('laborcostlist')){
            $_SESSION['laborcostlist'] =array();
        }
        // \app\models\Methods::print_array($_SESSION); 
        if ($model->load(Yii::$app->request->post()) || isset($_REQUEST['hidden'])) {
            if($_REQUEST['hidden'] =="addlists"){
                array_push( $_SESSION['laborcostlist'], Yii::$app->request->post());
                $_REQUEST['hidden'] = "";
                $model->workclassify_id ='';
                $model->amount= 0;
                
            }else if($_REQUEST['hidden'] =="savelists"){
                //ทำการบันทึกข้อมูลการจ่ายงวดรายช่าง
                // \app\models\Methods::print_array($_SESSION['laborcostlist']);
                $inst =  $this->saveInstalmentDetails($_SESSION['laborcostlist']);
                
                unset($_SESSION['laborcostlist']);
                $session->setFlash('save_res', 'ทำการบันทึกข้อมูลเรียบร้อยแล้ว');  
               
                $_REQUEST['hidden'] = "";
                return $this->redirect('index.php?r=employee/instalment/index');
            }
        }
        // \app\models\Methods::print_array($_SESSION['laborcostlist']); 
        return $this->render('instalment-by-instructor',[
            'model' => $model,
            'addlist' => $_SESSION['laborcostlist'],
            'instalment' => $instalment
        ]);
    }

    public function actionInstalment_by_instructor_detail($instalment_id){
        $this->layout = "employee_layout";
        $query = new Query;
        $paidbycash =array();
        $paidbybanks = array();
        // compose the query
        // $query->select('SUM(amount) as sum, instalment_id, contructor_id')
        // ->from('instalmentcostdetails')
        // ->groupBy('instalment_id');
        $query->select('b.*,b.create_date as bb, a.total, c.instalment, c.monthly, c.year')
            ->from('summoney a')
            ->leftJoin('instalmentcostdetails b', 'a.instalment_id = b.instalment_id')
            ->leftJoin('instalment c', 'a.instalment_id = c.id')
            ->where(['a.instalment_id'=> $instalment_id])
            ->orderBy('b.contructor_id, b.money_type_id', 'asc')
            ->groupBy('b.id')
            ->all();
        $rows = $query->all();
        $command = $query->createCommand();
        $rows = $command->queryAll();
        // foreach($rows as $r){
        //     $s = new \app\models\Summoney();
        //     $s->contructor_id = $r['contructor_id'];
        //     $s->total = $r['sum'];
        //     $s->instalment_id = $r['instalment_id'];
        //     $s->save();
        // }
         \app\models\Methods::print_array($rows);
        //
        $paidbycash = $this->getpaidByCashOrBank(1, $instalment_id);//paidtype =1, instalment_id
        $paidbybanks = $this->getpaidByCashOrBank(2, $instalment_id);
        
        // getข้อมูลการโอนเงินให้ช่างแยกเป็นธนาคาร(bank_id, instalment_id, paid_type)
        $ktb = $this->getTransferDivideBank(1, $instalment_id, 2);
        $scb = $this->getTransferDivideBank(2, $instalment_id, 2);
        $tmb = $this->getTransferDivideBank(3, $instalment_id, 2);
        $kb  = $this->getTransferDivideBank(4, $instalment_id, 2);
        $ksb = $this->getTransferDivideBank(5, $instalment_id, 2);
        $bkb = $this->getTransferDivideBank(6, $instalment_id, 2);
        $gsb = $this->getTransferDivideBank(7, $instalment_id, 2);
        // \app\models\Methods::print_array($ktb);
        return $this->render('instalment_by_instructor_detail',[
            'models' => $rows,
            'paidbycash' => $paidbycash,
            'paidbybanks' => $paidbybanks,
            'ktb' => $ktb,
            'scb' => $scb,
            'tmb' => $tmb,
            'kb' =>  $kb ,
            'ksb' => $ksb,
            'bkb' => $bkb,
            'gsb' => $gsb, 
        ]);

    }

    public function actionUnsetArray($id){
        $session = Yii::$app->session;
        unset($_SESSION['laborcostlist'][$id]);
        array_splice($_SESSION['laborcostlist'], 0, 0);

        return $this->redirect([
            'employee/instalment/instalment_by_instructor',
            'instalment_id' => $_REQUEST['instalment_id']
        ]);
     }
    /**
     * Finds the Instalment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Instalment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instalment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function saveInstalmentDetails($lists){
        // \app\models\Methods::print_array($lists);
        $session = Yii::$app->session;
        foreach($lists  as $key => $req){
            $m_type = $req['Instalmentcostdetails']['money_type_id'];
            $model = new \app\models\Instalmentcostdetails ();
            $model->instalment_id      = $req['Instalmentcostdetails']['instalment_id'];
            $model->contructor_id      = $req['Instalmentcostdetails']['contructor_id'];
            $model->house_id           = $req['Instalmentcostdetails']['house_id'];
            $model->workclassify_id    = $req['Instalmentcostdetails']['workclassify_id'];
            $model->worktype_id        = $req['Laborcostdetails']['workgroup'];
            $model->work_id            = $req['Laborcostdetails']['works'];
            $model->money_type_id      = $m_type;
            if($m_type == 3 ){ //เงินยืม
                $model->amount         = $req['deduction']['loan_deduction']['amount'];
            }else if($m_type == 4){ //เงินค่าอุปกรณ์
                $model->amount         = $req['deduction']['equipment_deduction']['amount'];
            }else{
                $model->amount         = $req['Instalmentcostdetails']['amount'];
            }
            $model->summoney_id        = 0;
            $model->saver_id           = Yii::$app->user->identity->id;
            $model->comment            = $req['Instalmentcostdetails']['comment'];
            $model->create_date        = date('y-m-d H:i:s');
            $model->update_date        = date('y-m-d H:i:s');
            $model->save();
        }
        // \app\models\Methods::print_array($lists);
        // $summoney = $this->sumAmountByIstalment();
        return $lists[0]['Instalmentcostdetails']['instalment_id'];
       
    }

    public function sumAmountByInstalment(){
        $query = new Query;
        // compose the query
        $query->select('sum(amount)as total, contructor_id, instalment_id')
            ->from('instalmentcostdetails')
            // ->where(['instalment_id'=>1])
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

    private function getpaidByCashOrBank($paidtype, $instalment_id){
        // รายงานการจ่ายเงินงวดงานโดยจ่ายเงินสด
        $query = new Query();
        $query->select('a.*, b.contructor_id, c.name, d.total, 
                        e.paid_type, e.paid_amount,e.id')
                ->from('instalment a')
                ->leftJoin('instalmentcostdetails b', 'a.id = b.instalment_id')
                ->leftJoin('profile c', 'b.contructor_id = c.user_id')
                ->leftJoin('summoney d', 'c.user_id = d.contructor_id')
                ->leftJoin('paidtype e', 'd.id = e.summoney_id')
                ->where(['a.id' => $instalment_id])
                ->andWhere(['e.paid_type' => $paidtype])
                ->groupBy('e.id', 'asc');
        $command = $query->createCommand();
        $model   = $command->queryAll();
        return $model;
        // \app\models\Form::print_array($model);
    }

    private function getTransferDivideBank($bank_id, $instalment_id, $paidtype){
        $query = new Query();
        $query->select('a.*, 
                        b.contructor_id,
                        c.name,
                        d.total,
                        e.paid_type,e.paid_amount,e.id,
                        f.account_bank,
                        g.id as bank_id, g.name as bank')
                       
            ->from('instalment a')
            ->leftJoin('instalmentcostdetails b', 'a.id = b.instalment_id')
            ->leftJoin('profile c', 'b.contructor_id = c.user_id')
            ->leftJoin('summoney d', 'c.user_id = d.contructor_id')
            ->leftJoin('paidtype e', 'd.id = e.summoney_id')
            ->leftJoin('user_bookbank_info f', 'c.user_id = f.user_id')
            ->leftJoin('banks g', 'f.bank_id = g.id')
            ->where(['a.id' => $instalment_id])
            ->andWhere(['e.paid_type' => $paidtype])
            ->andWhere(['g.id' => $bank_id])
            ->groupBy('e.id', 'asc');
            
        $command = $query->createCommand();
        $model   = $command->queryAll();
         return count($model)> 0 ? $model : array();
                    // \app\models\Methods::print_array($model);

    }
    
}
