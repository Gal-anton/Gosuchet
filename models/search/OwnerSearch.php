<?php

namespace app\models\search;

use app\models\tables\Okato;
use app\models\tables\Okopf;
use app\models\tables\Oktmo;
use app\models\tables\Okved;
use app\models\tables\Owner;
use app\models\tables\TipOrganisation;
use app\models\tables\VidOrganisation;
use app\models\tables\VidSob;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OwnerSearch represents the model behind the search form of `app\models\tables\Owner`.
 */
class OwnerSearch extends Owner
{

    public $tip_name;
    public $vid_name;
    public $kod_okved;
    public $kod_okato;
    public $kod_oktmo;
    public $kod_okfs;
    public $kod_okopf;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_owner', 'reg_num'], 'integer'],
            [['name', 'tip_name', 'vid_name', 'kod_okved', 'kod_okato', 'kod_oktmo', 'kod_okfs', 'kod_okopf'], 'safe'],
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
        $query = Owner::find();
        $query->joinWith('tip');
        $query->joinWith('idV');
        $query->joinWith('okved');
        $query->joinWith('okato');
        $query->joinWith('okfs');
        $query->joinWith('okopf');
        $query->joinWith('oktmo');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['tip_name'] = [
            'asc' => [TipOrganisation::tableName() . '.tip_name' => SORT_ASC],
            'desc' => [TipOrganisation::tableName() . '.tip_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['vid_name'] = [
            'asc' => [VidOrganisation::tableName() . '.vid_name' => SORT_ASC],
            'desc' => [VidOrganisation::tableName() . '.vid_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['owner_name'] = [
            'asc' => [Owner::tableName() . '.name' => SORT_ASC],
            'desc' => [Owner::tableName() . '.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kod_okved'] = [
            'asc' => [Okved::tableName() . '.kod_okved' => SORT_ASC],
            'desc' => [Okved::tableName() . '.kod_okved' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kod_okato'] = [
            'asc' => [Okato::tableName() . '.kod_okato' => SORT_ASC],
            'desc' => [Okato::tableName() . '.kod_okato' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kod_oktmo'] = [
            'asc' => [Oktmo::tableName() . '.kod_oktmo' => SORT_ASC],
            'desc' => [Oktmo::tableName() . '.kod_oktmo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kod_okfs'] = [
            'asc' => [VidSob::tableName() . '.kod_okfs' => SORT_ASC],
            'desc' => [VidSob::tableName() . '.kod_okfs' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kod_okopf'] = [
            'asc' => [Okopf::tableName() . '.kod_okopf' => SORT_ASC],
            'desc' => [Okopf::tableName() . '.kod_okopf' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_owner' => $this->id_owner,
            'reg_num' => $this->reg_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', TipOrganisation::tableName() . '.name_tip', $this->tip_name])
            ->andFilterWhere(['like', Okved::tableName() . '.kod_okved', $this->kod_okved])
            ->andFilterWhere(['like', Okato::tableName() . '.kod_okato', $this->kod_okato])
            ->andFilterWhere(['like', Oktmo::tableName() . '.kod_oktmo', $this->kod_oktmo])
            ->andFilterWhere(['like', VidSob::tableName() . '.kod_okfs', $this->kod_okfs])
            ->andFilterWhere(['like', Okopf::tableName() . '.kod_okopf', $this->kod_okopf])
            ->andFilterWhere(['like', VidOrganisation::tableName() . '.name_vid', $this->vid_name]);

        return $dataProvider;
    }
}
