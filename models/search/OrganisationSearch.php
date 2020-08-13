<?php

namespace app\models\search;

use app\models\tables\Organisation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrganisationSearch represents the model behind the search form of `app\models\Organisation`.
 */
class OrganisationSearch extends Organisation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_tip', 'id_vid', 'id_okved', 'id_okato', 'id_oktmo', 'id_okfs', 'id_buj', 'id_okopf'], 'integer'],
            [['reg_num', 'full_name', 'short_name', 'inn', 'ppo', 'id_owner', 'created_at', 'updated_at'], 'safe'],
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
        $query = Organisation::find();

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
            'id_org' => $this->id_org,
            'id_tip' => $this->id_tip,
            'id_vid' => $this->id_vid,
            'id_okved' => $this->id_okved,
            'id_okato' => $this->id_okato,
            'id_oktmo' => $this->id_oktmo,
            'id_okfs' => $this->id_okfs,
            'id_buj' => $this->id_buj,
            'id_okopf' => $this->id_okopf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reg_num', $this->reg_num])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'ppo', $this->ppo])
            ->andFilterWhere(['like', 'id_owner', $this->id_owner]);

        return $dataProvider;
    }
}
