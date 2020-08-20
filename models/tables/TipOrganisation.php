<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "tip_organisation".
 *
 * @property int $id_tip
 * @property int $kod_tip
 * @property string $name_tip
 *
 * @property Organisation[] $organisations
 */
class TipOrganisation extends ActiveRecord
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
            'id_tip' => 'Номер записи',
            'kod_tip' => 'Код типа организации',
            'name_tip' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_tip' => 'id_tip']);
    }
}
