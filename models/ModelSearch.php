<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * ModelSearch represents the model behind the search form of `app\models\Model`.
 */
class ModelSearch extends Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mod', 'kod_mod'], 'integer'],
            [['name_mod'], 'safe'],
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
        $query = Model::find();

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
            'id_mod' => $this->id_mod,
            'kod_mod' => $this->kod_mod,
        ]);

        $query->andFilterWhere(['like', 'name_mod', $this->name_mod]);

        return $dataProvider;
    }
}
