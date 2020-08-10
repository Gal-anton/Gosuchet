<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Okved;

/**
 * OkvedSearch represents the model behind the search form of `app\models\Okved`.
 */
class OkvedSearch extends Okved
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_okved', 'kod_okved'], 'integer'],
            [['name_okved'], 'safe'],
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
        $query = Okved::find();

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
            'id_okved' => $this->id_okved,
            'kod_okved' => $this->kod_okved,
        ]);

        $query->andFilterWhere(['like', 'name_okved', $this->name_okved]);

        return $dataProvider;
    }
}
