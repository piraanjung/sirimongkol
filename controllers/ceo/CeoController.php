<?php

namespace app\controllers\ceo;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\WorkType;
use app\models\Housemodels;
use app\models\Houses;


class CeoController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout' ,'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "ceo";

        $sql_one = 'select a.project_id,
        a.projectname, a.start_date, a.end_date,a.control_statement,
        count(b.id) as unit_count
        from project a
        left join houses b on a.project_id = b.project_id
        group by a.projectname,a.control_statement,b.project_id;';
        $data_one = Yii::$app->db->createCommand($sql_one)->queryAll();
        // \app\models\Methods::print_array($data_one);

        $sql = 'select b.wc_name,sum(a.amount) as paid 
                from instalmentcostdetails a
                inner join work_category b on a.workclassify_id = b.id
                group by a.workclassify_id
                order by b.id asc;';
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        
        $arr_data = [];
        array_push($arr_data, ['wc_name','จ่าย(บาท)']);
        foreach ($data as $row){
            $d1 = [$row['wc_name'], (int)$row['paid']];
            array_push($arr_data,$d1);
        }
        
        $sql_payee = 'select b.username,sum(a.amount) as paid 
                    from instalmentcostdetails a
                    inner join user b on a.saver_id = b.id
                    group by b.username';
        $data_payee = Yii::$app->db->createCommand($sql_payee)->queryAll();
        
        $arr_payee = [];
        array_push($arr_payee, ['username','paid']);
        foreach ($data_payee as $row){
            $d1 = [$row['username'], (int)$row['paid']];
            array_push($arr_payee, $d1);
        }
        
        $sql_grid = 'select a.projectname,
                    ifnull(sum(d.work_control_statement),0)as fixpaid,
                    ifnull(sum(c.amount),0)as paid 
                    from project a
                    left join instalment b on a.project_id = b.project_id
                    left join instalmentcostdetails c on b.id = c.instalment_id
                    left join works d on c.work_id = d.id
                    group by a.projectname;';
        $data_grid = Yii::$app->db->createCommand($sql_grid)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data_grid
        ]);
        
        return $this->render('index',[
            'boxs' => $data_one,
            'chart1' => array_values($arr_data),
            'chart_payee' => array_values($arr_payee),
            'dataProvider' => $dataProvider
        ]);
    }



    public function actionProjectdetail($project_id){
        $this->layout = 'ceo';
        $query = new Query();
        $command = $query->select(['h.*', 'hm.hm_name','hm.hm_control_statment'])
            ->from('houses h')
            ->leftJoin('house_model hm', ' h.house_model_id = hm.id')
            ->where(['h.project_id'=> $project_id])
            ->all();
        // \app\models\Methods::print_array($command);
        $project = \app\models\Project::find()
                ->where(['project_id' => $project_id])
                ->one();    
                
        $provider = new ArrayDataProvider([
            'allModels' =>$command,
            // 'sort' => [
            //     'attributes' => ['id', 'username', 'email'],
            // ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        $query2 = new Query;
        // $query2->select('a.*, b.*')
        //     ->from('instalmentcostdetails a')
        //     ->leftJoin('instalment b', 'a.instalment_id = b.instalment')
        //     ->where(['b.project_id' => $project_id])
        //     ->groupBy('a.instalment_id');
        $query2->select('a.*, b.*')
                ->from('instalment a')
                ->leftJoin('instalmentcostdetails b', 'a.id = b.instalment_id')
                ->where(['a.project_id' => $project_id]);
        $model = $query2->all();
        // \app\models\Methods::print_array($model);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $model,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

        
        $houseCount = Houses::find()->all();
        $noneBuildedHouses = Houses::countHousesByStatus(0, $project_id);
        $duringBuildedHouses = Houses::countHousesByStatus(1,$project_id);
        $completeBuildedHoueses  = Houses::countHousesByStatus(2, $project_id);
        // $sumControlStatement = Houses::sumControllStatement();
        $sumPaidAmountByProject = Houses::sumPaidAmountByProject($project_id);
        // \app\models\Form::print_array($houseCount);
        return $this->render('projectdetail', [
            'houseCount' => $houseCount,
            'noneBuildedHouses' => $noneBuildedHouses,
            'duringBuildedHouses' => $duringBuildedHouses,
            'completeBuildedHoueses' => $completeBuildedHoueses,
            // 'sumControlStatement' => $sumControlStatement,
            'sumPaidAmountByProject' => $sumPaidAmountByProject,
            'provider' => $provider,
            'dataProvider' => $dataProvider,
            'project' => $project
        ]);
    }
}

