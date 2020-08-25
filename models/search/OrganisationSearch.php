<?php

namespace app\models\search;

use app\models\tables\Organisation;
use app\models\tables\Owner;
use app\models\tables\TipOrganisation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrganisationSearch represents the model behind the search form of `app\models\tables\Organisation`.
 */
class OrganisationSearch extends Organisation
{

    public $tip_name;
    public $owner_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'id_tip', 'id_vid', 'id_okved', 'id_okato', 'id_oktmo', 'id_okfs', 'id_buj', 'id_okopf'], 'integer'],
            [['reg_num', 'full_name', 'short_name', 'inn', 'ppo', 'id_owner', 'created_at', 'updated_at', 'tip_name', 'owner_name'], 'safe'],
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
        $query->joinWith('tip');
        $query->joinWith('owner');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['name_tip'] = [
            'asc' => [TipOrganisation::tableName() . '.name_tip' => SORT_ASC],
            'desc' => [TipOrganisation::tableName() . '.name_tip' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['owner_name'] = [
            'asc' => [TipOrganisation::tableName() . '.name' => SORT_ASC],
            'desc' => [TipOrganisation::tableName() . '.name' => SORT_DESC],
        ];


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
            'owner_name' => $this->owner_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reg_num', $this->reg_num])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'ppo', $this->ppo])
            ->andFilterWhere(['like', TipOrganisation::tableName() . '.name_tip', $this->tip_name])
            ->andFilterWhere(['like', Owner::tableName() . '.name', $this->owner_name]);

        return $dataProvider;
    }
}
