<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Instalmentcostdetails;

/**
 * InstalmentSearch represents the model behind the search form about `app\models\Instalment`.
 */
class TestSearch extends Instalment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monthly', 'year'], 'integer'],
            [['instalment', 'project_id', 'editor_id', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // $query = Instalment::find();
        $sql_grid = 'select 
            a.*, 
            b.hm_name,b.hm_control_statment,
            (select sum(amount) as _total
                from instalmentcostdetails
                where house_id = a.id) as sum_amount 
            from houses a
            left join house_model b ON a.house_model_id = b.id
            where a.project_id=6';
        // $query = Yii::$app->db->createCommand($sql_grid)->queryAll();
        $query = Instalmentcostdetails::findBySql($sql_grid)->one();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            // 'hm_control_statment' => $this->hm_control_statment,
            // 'year' => $this->year,
            // 'create_date' => $this->create_date,
            // 'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'project_id', $this->project_id])
            ->andFilterWhere(['like', 'editor_id', $this->editor_id]);

        return $dataProvider;
    }
}
