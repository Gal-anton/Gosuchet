<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Oktmo;

/**
 * OktmoSearch represents the model behind the search form of `app\models\Oktmo`.
 */
class OktmoSearch extends Oktmo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_oktmo', 'kod_oktmo', 'population'], 'integer'],
            [['name_oktmo'], 'safe'],
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
        $query = Oktmo::find();

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
            'id_oktmo' => $this->id_oktmo,
            'kod_oktmo' => $this->kod_oktmo,
            'population' => $this->population,
        ]);

        $query->andFilterWhere(['like', 'name_oktmo', $this->name_oktmo]);

        return $dataProvider;
    }
}
