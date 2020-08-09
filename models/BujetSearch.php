<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bujet;

/**
 * BujetSearch represents the model behind the search form of `app\models\Bujet`.
 */
class BujetSearch extends Bujet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_buj', 'kod_buj'], 'integer'],
            [['name_buj'], 'safe'],
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
        $query = Bujet::find();

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
            'id_buj' => $this->id_buj,
            'kod_buj' => $this->kod_buj,
        ]);

        $query->andFilterWhere(['like', 'name_buj', $this->name_buj]);

        return $dataProvider;
    }
}
