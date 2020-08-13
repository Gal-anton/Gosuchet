<?php

namespace app\models\search;

use app\models\tables\Dmu;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DmuSearch represents the model behind the search form of `app\models\Dmu`.
 */
class DmuSearch extends Dmu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dmu', 'kod_is', 'id_fun', 'id_mod', 'id_input', 'sum_input', 'id_output', 'sum_output', 'efficency'], 'integer'],
            [['dmu_dmu', 'created_at', 'updated_at'], 'safe'],
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
        $query = Dmu::find();

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
            'id_dmu' => $this->id_dmu,
            'kod_is' => $this->kod_is,
            'id_fun' => $this->id_fun,
            'id_mod' => $this->id_mod,
            'id_input' => $this->id_input,
            'sum_input' => $this->sum_input,
            'id_output' => $this->id_output,
            'sum_output' => $this->sum_output,
            'efficency' => $this->efficency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'dmu_dmu', $this->dmu_dmu]);

        return $dataProvider;
    }
}
