<?php

namespace app\models\search;

use app\models\tables\Inputs;
use app\models\tables\OrgFunction;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * InputsSearch represents the model behind the search form of `app\models\Inputs`.
 */
class InputsSearch extends Inputs
{


    public $name_fun;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_input', 'kod_input', 'id_fun'], 'integer'],
            [['name_input', 'name_fun'], 'safe'],
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
        $query = Inputs::find();
        $query->joinWith('fun');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['name_fun'] = [
            'asc' => [OrgFunction::tableName() . '.name_fun' => SORT_ASC],
            'desc' => [OrgFunction::tableName() . '.name_fun' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_input' => $this->id_input,
            'kod_input' => $this->kod_input,
            'id_fun' => $this->id_fun,
            'name_fun' => $this->name_fun,
        ]);

        $query->andFilterWhere(['like', 'name_input', $this->name_input])
            ->andFilterWhere(['like', OrgFunction::tableName() . '.name_fun', $this->name_fun]);

        return $dataProvider;
    }
}
