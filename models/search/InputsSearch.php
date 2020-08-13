<?php

namespace app\models\search;

use app\models\tables\Inputs;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * InputsSearch represents the model behind the search form of `app\models\Inputs`.
 */
class InputsSearch extends Inputs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_input', 'kod_input', 'id_fun'], 'integer'],
            [['name_input'], 'safe'],
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
        $query = Inputs::find();

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
            'id_input' => $this->id_input,
            'kod_input' => $this->kod_input,
            'id_fun' => $this->id_fun,
        ]);

        $query->andFilterWhere(['like', 'name_input', $this->name_input]);

        return $dataProvider;
    }
}
