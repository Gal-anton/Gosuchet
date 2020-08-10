<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oktmo".
 *
 * @property int $id_oktmo
 * @property int $kod_oktmo
 * @property string $name_oktmo
 * @property int $population
 *
 * @property Organisation[] $organisations
 */
class Oktmo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oktmo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_oktmo'], 'required'],
            [['kod_oktmo', 'population'], 'integer'],
            [['name_oktmo'], 'string', 'max' => 65],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_oktmo' => 'Id Oktmo',
            'kod_oktmo' => 'Kod Oktmo',
            'name_oktmo' => 'Name Oktmo',
            'population' => 'Population',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_oktmo' => 'id_oktmo']);
    }
}
