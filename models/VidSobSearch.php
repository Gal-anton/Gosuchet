<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VidSob;

/**
 * VidSobSearch represents the model behind the search form of `app\models\VidSob`.
 */
class VidSobSearch extends VidSob
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_okfs', 'kod_okfs'], 'integer'],
            [['name_okfs'], 'safe'],
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
        $query = VidSob::find();

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
            'id_okfs' => $this->id_okfs,
            'kod_okfs' => $this->kod_okfs,
        ]);

        $query->andFilterWhere(['like', 'name_okfs', $this->name_okfs]);

        return $dataProvider;
    }
}
