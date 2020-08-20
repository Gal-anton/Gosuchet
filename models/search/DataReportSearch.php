<?php

namespace app\models\search;

use app\models\tables\DataReport;
use app\models\tables\OrgFunction;
use app\models\tables\Orgstruct;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DataReportSearch represents the model behind the search form of `app\models\DataReport`.
 */
class DataReportSearch extends DataReport
{

    public $name_orgstr;
    public $name_fun;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_data_report', 'id_org', 'report_year', 'report_staff_plan', 'report_staff_fact', 'report_sum_fin', 'report_sum_fot', 'id_orgstr', 'id_fun', 'resource_sum'], 'integer'],
            [['name_fun', 'name_orgstr'], 'safe'],
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
        $query = DataReport::find();

        // add conditions that should always apply here
        $query->joinWith('orgstr');
        $query->joinWith('fun');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['name_orgstr'] = [
            'asc' => [Orgstruct::tableName() . '.name_orgstr' => SORT_ASC],
            'desc' => [Orgstruct::tableName() . '.name_orgstr' => SORT_DESC],
        ];

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
            'id_data_report' => $this->id_data_report,
            'id_org' => $this->id_org,
            'report_year' => $this->report_year,
            'report_staff_plan' => $this->report_staff_plan,
            'report_staff_fact' => $this->report_staff_fact,
            'report_sum_fin' => $this->report_sum_fin,
            'report_sum_fot' => $this->report_sum_fot,
            'id_orgstr' => $this->id_orgstr,
            'id_fun' => $this->id_fun,
            'name_mod' => $this->name_orgstr,
            'name_fun' => $this->name_fun,
            'resource_sum' => $this->resource_sum,
        ]);

        $query->andFilterWhere(['like', Orgstruct::tableName() . '.name_orgstr', $this->name_orgstr])
            ->andFilterWhere(['like', OrgFunction::tableName() . '.name_fun', $this->name_fun]);
        return $dataProvider;
    }
}
