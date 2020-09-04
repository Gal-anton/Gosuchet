<?php

namespace app\models\search;

use app\models\tables\Owner;
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
            'id_owner' => $this->id_owner,
            'reg_num' => $this->reg_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
