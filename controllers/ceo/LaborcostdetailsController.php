<?php

namespace app\controllers\ceo;

use Yii;
use app\models\Instalmentcostdetails;
use app\models\InstalmentcostdetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Houses;
use app\models\Project;
use yii\db\Query;
use yii\data\ArrayDataProvider;
/**
 * LaborcostdetailsController implements the CRUD actions for Laborcostdetails model.
 */
class LaborcostdetailsController extends Controller
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
     * Lists all Laborcostdetails models.
     * @return mixed
     */
    
    public function actionIndex()
    {
        $this->layout = 'ceo';
        $query = new Query;
        $query->select('
                a.*, 
                b.*,
                d.projectname
            ')
            ->from('instalmentcostdetails a')
            ->leftJoin('instalment b', 'a.instalment_id = b.instalment')
            ->leftJoin('houses c', 'a.house_id = c.id')
            ->leftJoin('project d', 'c.project_id = d.project_id')
            ->where(['b.project_id' => $_REQUEST['project_id']])
            ->andWhere(['a.instalment_id' => $_REQUEST['instalment']])
            ->groupBy('a.instalment_id');
        $model = $query->all();
        // \app\models\Form::print_array($model);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        $query3 = new Query();
        $command = $query3->select(['h.*', 'hm.hm_name'])
            ->from('houses h')
            ->leftJoin('house_model hm', ' h.house_model_id = hm.id')
            
            ->all();
            
        $provider = new ArrayDataProvider([
            'allModels' =>$command,

            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'provider' => $provider,
            'model'    => $model,
            'instalment' => $_REQUEST['instalment']

        ]);

    }

    public function actionInstalmentdetail_by_house(){
        //  \app\models\Form::print_array($_REQUEST);
        $this->layout = 'ceo';
        $query = new Query;
        $query->select('a.*, 
                b.name as constructorname ,
                c.wc_name,
                d.work_type_name,
                e.instalment, e.monthly as instalment_monthly, e.year as instalment_year,
                f.name as moneytype,
                g.house_id, g.project_id,
                h.house_model_name
            ')
            ->from('instalmentcostdetails a')
            ->leftJoin('payee b', 'a.contructor_id = b.id')
            ->leftJoin('work_classify c', 'a.workclassify_id = c.id ')
            ->leftJoin('work_type d', 'a.worktype_id = d.id')
            ->leftJoin('instalment e', 'a.instalment_id = e.id')
            ->leftJoin('money_type f', 'a.money_type_id = f.id')
            ->leftJoin('houses g', 'a.house_id = g.house_id')
            ->leftJoin('housemodels h', 'g.house_model = h.id')
            ->where(['a.house_id' => $_REQUEST['house_id']])
            ->andWhere(['a.instalment_id' => $_REQUEST['instalment_id']])
            ;
        $instalment = $query->all();    

        return $this->render('instalmentdetail_by_house',[
            'instalment' => $instalment,
        ]);
    }



    /**
     * Displays a single Laborcostdetails model.
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
     * Creates a new Laborcostdetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Laborcostdetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Laborcostdetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Laborcostdetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Laborcostdetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Laborcostdetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Laborcostdetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
