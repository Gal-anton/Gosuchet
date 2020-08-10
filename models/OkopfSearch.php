<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Okopf;

/**
 * OkopfSearch represents the model behind the search form of `app\models\Okopf`.
 */
class OkopfSearch extends Okopf
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_okopf', 'kod_okopf'], 'integer'],
            [['name_okopf'], 'safe'],
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
        $query = Okopf::find();

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
            'id_okopf' => $this->id_okopf,
            'kod_okopf' => $this->kod_okopf,
        ]);

        $query->andFilterWhere(['like', 'name_okopf', $this->name_okopf]);

        return $dataProvider;
    }
}
