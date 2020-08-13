<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "oktmo".
 *
 * @property int $id_oktmo
 * @property string $kod_oktmo
 * @property string $name_oktmo
 * @property int $population
 *
 * @property Organisation[] $organisations
 */
class Oktmo extends ActiveRecord
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
            [['population'], 'integer'],
            [['name_oktmo'], 'string', 'max' => 255],
            [['kod_oktmo'], 'string', 'max' => 11],
            [['kod_oktmo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_oktmo' => 'Номер записи',
            'kod_oktmo' => 'Код ОКТМО',
            'name_oktmo' => 'Наименование',
            'population' => 'Население',
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
