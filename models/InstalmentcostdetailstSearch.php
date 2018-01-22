<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Instalmentcostdetails;

/**
 * InstalmentcostdetailstSearch represents the model behind the search form about `app\models\Instalmentcostdetails`.
 */
class InstalmentcostdetailstSearch extends Instalmentcostdetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'instalment_id', 'contructor_id', 'house_id', 'workclassify_id', 'worktype_id', 'money_type_id', 'summoney_id', 'saver_id'], 'integer'],
            [['amount', 'ceiling_money'], 'number'],
            [['comment'], 'string'],
            [['create_date', 'update_date'], 'safe'],
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
        $query = Instalmentcostdetails::find();

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
            'id' => $this->id,
            'instalment_id' => $this->instalment_id,
            'contructor_id' => $this->contructor_id,
            'house_id' => $this->house_id,
            'workclassify_id' => $this->workclassify_id,
            'worktype_id' => $this->worktype_id,
            'money_type_id' => $this->money_type_id,
            'ceiling_money' => $this->ceiling_money,
            'amount' => $this->amount,
            'summoney_id' => $this->summoney_id,
            'saver_id' => $this->saver_id,
            'comment' => $this->comment,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
