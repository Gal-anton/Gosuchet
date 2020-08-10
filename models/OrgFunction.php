<?php

namespace app\models;

use Yii;

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
class OrgFunction extends \yii\db\ActiveRecord
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
            'id_fun' => 'Id Fun',
            'kod_fun' => 'Kod Fun',
            'name_fun' => 'Name Fun',
            'id_tip' => 'Id Tip',
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
    public function getTip()
    {
        return $this->hasOne(TipOrganisation::className(), ['id_tip' => 'id_tip']);
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
