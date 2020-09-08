<?php

namespace app\models\search;

use app\models\tables\DataReport;
use app\models\tables\Dmu;
use app\models\tables\Organisation;
use app\models\tables\Orgstruct;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DataReportSearch represents the model behind the search form of `app\models\tables\DataReport`.
 */
class DataReportSearch extends DataReport
{
    public $name_org;
    public $dmu_dmu;
    public $name_orgstr;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_data_report', 'id_org', 'id_dmu', 'id_orgstr', 'input', 'output', 'efficency'], 'integer'],
            [['created_at', 'updated_at', 'name_org', 'dmu_dmu', 'name_orgstr'], 'safe'],
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
        $query->joinWith('org');
        $query->joinWith('orgstr');
        $query->joinWith('dmu');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['dmu_dmu'] = [
            'asc' => [Dmu::tableName() . '.dmu_dmu' => SORT_ASC],
            'desc' => [Dmu::tableName() . '.dmu_dmu' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name_orgstr'] = [
            'asc' => [Orgstruct::tableName() . '.name_orgstr' => SORT_ASC],
            'desc' => [Orgstruct::tableName() . '.name_orgstr' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name_org'] = [
            'asc' => [Organisation::tableName() . '.short_name' => SORT_ASC],
            'desc' => [Organisation::tableName() . '.short_name' => SORT_DESC],
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
            'data_report.id_dmu' => $this->id_dmu,
            'id_orgstr' => $this->id_orgstr,
            'input' => $this->input,
            'output' => $this->output,
            'efficency' => $this->efficency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', Organisation::tableName() . '.short_name', $this->name_org])
            ->andFilterWhere(['like', Dmu::tableName() . '.dmu_dmu', $this->dmu_dmu])
            ->andFilterWhere(['like', Orgstruct::tableName() . '.name_orgstr', $this->name_orgstr]);

        return $dataProvider;
    }
}
