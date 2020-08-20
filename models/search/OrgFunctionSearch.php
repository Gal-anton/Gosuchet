<?php

namespace app\models\search;

use app\models\tables\OrgFunction;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrgFunctionSearch represents the model behind the search form of `app\models\tables\OrgFunction`.
 */
class OrgFunctionSearch extends OrgFunction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fun', 'kod_fun', 'autonomus', 'budgetary', 'kazennoe'], 'integer'],
            [['name_fun'], 'safe'],
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
        $query = OrgFunction::find();

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
            'id_fun' => $this->id_fun,
            'kod_fun' => $this->kod_fun,
            'autonomus' => $this->autonomus,
            'budgetary' => $this->budgetary,
            'kazennoe' => $this->kazennoe,
        ]);

        $query->andFilterWhere(['like', 'name_fun', $this->name_fun]);

        return $dataProvider;
    }
}
