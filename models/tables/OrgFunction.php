<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "org_function".
 *
 * @property int $id_fun
 * @property string $kod_fun
 * @property string $name_fun
 * @property int $autonomus
 * @property int $budgetary
 * @property int $kazennoe
 *
 * @property DataReport[] $dataReports
 * @property Dmu[] $dmus
 * @property Inputs[] $inputs
 * @property Orgstruct[] $orgstructs
 * @property Outputs[] $outputs
 */
class OrgFunction extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'org_function';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_fun'], 'required'],
            [['kod_fun'], 'string', 'max' => 11],
            [['autonomus', 'budgetary', 'kazennoe'], 'boolean'],
            [['name_fun'], 'string', 'max' => 255],
            [['kod_fun'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_fun' => 'Номер записи',
            'kod_fun' => 'Код функции',
            'name_fun' => 'Наименование',
            'autonomus' => 'Автономные учреждения',
            'budgetary' => 'Бюджетные учреждения',
            'kazennoe' => 'Казенные учреждения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInputs()
    {
        return $this->hasMany(Inputs::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgstructs()
    {
        return $this->hasMany(Orgstruct::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutputs()
    {
        return $this->hasMany(Outputs::className(), ['id_fun' => 'id_fun']);
    }
}
