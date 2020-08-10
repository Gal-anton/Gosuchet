<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_report".
 *
 * @property int $id_data_report
 * @property int $id_org
 * @property int $report_year
 * @property int $report_staff_plan
 * @property int $report_staff_fact
 * @property int $report_sum_fin
 * @property int $report_sum_fot
 * @property int $id_orgstr
 * @property int $id_fun
 * @property int $resource_sum
 *
 * @property Function $fun
 * @property Organisation $org
 * @property Orgstruct $orgstr
 */
class DataReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'report_year', 'report_staff_plan', 'report_staff_fact', 'report_sum_fin', 'report_sum_fot', 'id_orgstr', 'id_fun', 'resource_sum'], 'required'],
            [['id_org', 'report_year', 'report_staff_plan', 'report_staff_fact', 'report_sum_fin', 'report_sum_fot', 'id_orgstr', 'id_fun', 'resource_sum'], 'integer'],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => Function::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organisation::className(), 'targetAttribute' => ['id_org' => 'id_org']],
            [['id_orgstr'], 'exist', 'skipOnError' => true, 'targetClass' => Orgstruct::className(), 'targetAttribute' => ['id_orgstr' => 'id_orgstr']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_data_report' => 'Id Data Report',
            'id_org' => 'Id Org',
            'report_year' => 'Report Year',
            'report_staff_plan' => 'Report Staff Plan',
            'report_staff_fact' => 'Report Staff Fact',
            'report_sum_fin' => 'Report Sum Fin',
            'report_sum_fot' => 'Report Sum Fot',
            'id_orgstr' => 'Id Orgstr',
            'id_fun' => 'Id Fun',
            'resource_sum' => 'Resource Sum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(Function::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organisation::className(), ['id_org' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgstr()
    {
        return $this->hasOne(Orgstruct::className(), ['id_orgstr' => 'id_orgstr']);
    }
}
