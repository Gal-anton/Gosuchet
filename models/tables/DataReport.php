<?php

namespace app\models\tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property OrgFunction $fun
 * @property Organisation $org
 * @property Orgstruct $orgstr
 */
class DataReport extends ActiveRecord
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
            [['id_org', 'report_staff_plan', 'report_staff_fact', 'report_sum_fin', 'report_sum_fot', 'id_orgstr', 'id_fun', 'resource_sum'], 'integer', 'min' => 0],
            [['report_year'], 'integer', 'max' => (int)date('Y'), 'min' => 1900],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => OrgFunction::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
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
            'id_data_report' => 'Номер записи',
            'id_org' => 'Номер организации',
            'report_year' => 'Отчетный год',
            'report_staff_plan' => 'Штатная численность организации',
            'report_staff_fact' => 'Среднесписочная численность организации',
            'report_sum_fin' => 'Общая сумма финансирования',
            'report_sum_fot' => 'Сумма ФОТ',
            'id_orgstr' => 'Тип структуры',
            'id_fun' => 'Вид функции',
            'resource_sum' => 'Количество интеллектуальных агентов',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organisation::className(), ['id_org' => 'id_org']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrgstr()
    {
        return $this->hasOne(Orgstruct::className(), ['id_orgstr' => 'id_orgstr']);
    }
}
