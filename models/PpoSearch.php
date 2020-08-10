<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ppo;

/**
 * PpoSearch represents the model behind the search form of `app\models\Ppo`.
 */
class PpoSearch extends Ppo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ppo', 'kod_ppo'], 'integer'],
            [['name_ppo'], 'safe'],
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
        $query = Ppo::find();

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
            'id_ppo' => $this->id_ppo,
            'kod_ppo' => $this->kod_ppo,
        ]);

        $query->andFilterWhere(['like', 'name_ppo', $this->name_ppo]);

        return $dataProvider;
    }
}
