<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bujet".
 *
 * @property int $id_buj
 * @property int $kod_buj
 * @property string $name_buj
 *
 * @property Organisation[] $organisations
 */
class Bujet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bujet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_buj'], 'required'],
            [['kod_buj'], 'integer'],
            [['name_buj'], 'string', 'max' => 65],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_buj' => 'Id Buj',
            'kod_buj' => 'Kod Buj',
            'name_buj' => 'Name Buj',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_buj' => 'id_buj']);
    }
}
