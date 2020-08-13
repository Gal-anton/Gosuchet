<?php

namespace app\models\search;

use app\models\tables\TipOrganisation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TipOrganisationSearch represents the model behind the search form of `app\models\TipOrganisation`.
 */
class TipOrganisationSearch extends TipOrganisation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tip', 'kod_tip'], 'integer'],
            [['name_tip'], 'safe'],
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
        $query = TipOrganisation::find();

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
            'id_tip' => $this->id_tip,
            'kod_tip' => $this->kod_tip,
        ]);

        $query->andFilterWhere(['like', 'name_tip', $this->name_tip]);

        return $dataProvider;
    }
}
