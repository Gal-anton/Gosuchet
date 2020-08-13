<?php

namespace app\models\search;

use app\models\tables\Journal;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * JournalSearch represents the model behind the search form of `app\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_j', 'id_dmu', 'minX', 'maxX', 'minY', 'maxY', 'un_efficency'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = Journal::find();

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
            'id_j' => $this->id_j,
            'id_dmu' => $this->id_dmu,
            'minX' => $this->minX,
            'maxX' => $this->maxX,
            'minY' => $this->minY,
            'maxY' => $this->maxY,
            'un_efficency' => $this->un_efficency,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
