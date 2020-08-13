<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "org_function".
 *
 * @property int $id_fun
 * @property int $kod_fun
 * @property string $name_fun
 * @property int $id_tip
 *
 * @property DataReport[] $dataReports
 * @property Dmu[] $dmus
 * @property Inputs[] $inputs
 * @property TipOrganisation $tip
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
            [['kod_fun', 'id_tip'], 'required'],
            [['kod_fun', 'id_tip'], 'integer'],
            [['name_fun'], 'string', 'max' => 65],
            [['kod_fun'], 'unique'],
            [['id_tip'], 'unique'],
            [['id_tip'], 'exist', 'skipOnError' => true, 'targetClass' => TipOrganisation::className(), 'targetAttribute' => ['id_tip' => 'id_tip']],
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
            'id_tip' => 'Тип организации',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getInputs()
    {
        return $this->hasMany(Inputs::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTip()
    {
        return $this->hasOne(TipOrganisation::className(), ['id_tip' => 'id_tip']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrgstructs()
    {
        return $this->hasMany(Orgstruct::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOutputs()
    {
        return $this->hasMany(Outputs::className(), ['id_fun' => 'id_fun']);
    }
}
