<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tip_organisation".
 *
 * @property int $id_tip
 * @property int $kod_tip
 * @property string $name_tip
 *
 * @property OrgFunction[] $functions
 * @property Organisation[] $organisations
 */
class TipOrganisation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tip_organisation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_tip'], 'required'],
            [['kod_tip'], 'integer'],
            [['name_tip'], 'string', 'max' => 65],
            [['kod_tip'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tip' => 'Id Tip',
            'kod_tip' => 'Kod Tip',
            'name_tip' => 'Name Tip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunctions()
    {
        return $this->hasMany(OrgFunction::className(), ['id_tip' => 'id_tip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_tip' => 'id_tip']);
    }
}
