<?php

namespace app\models\search;

use app\models\tables\Orgstruct;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrgstructSearch represents the model behind the search form of `app\models\Orgstruct`.
 */
class OrgstructSearch extends Orgstruct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_orgstr', 'kod_orgstr', 'id_fun'], 'integer'],
            [['name_orgstr'], 'safe'],
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
        $query = Orgstruct::find();

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
            'id_orgstr' => $this->id_orgstr,
            'kod_orgstr' => $this->kod_orgstr,
            'id_fun' => $this->id_fun,
        ]);

        $query->andFilterWhere(['like', 'name_orgstr', $this->name_orgstr]);

        return $dataProvider;
    }
}
