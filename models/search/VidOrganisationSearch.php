<?php

namespace app\models\search;

use app\models\tables\VidOrganisation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VidOrganisationSearch represents the model behind the search form of `app\models\VidOrganisation`.
 */
class VidOrganisationSearch extends VidOrganisation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_vid', 'kod_vid'], 'integer'],
            [['name_vid'], 'safe'],
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
        $query = VidOrganisation::find();

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
            'id_vid' => $this->id_vid,
            'kod_vid' => $this->kod_vid,
        ]);

        $query->andFilterWhere(['like', 'name_vid', $this->name_vid]);

        return $dataProvider;
    }
}
