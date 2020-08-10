<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "okved".
 *
 * @property int $id_okved
 * @property string $kod_okved
 * @property string $name_okved
 *
 * @property Organisation[] $organisations
 */
class Okved extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'okved';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_okved'], 'required'],
            [['kod_okved'], 'string', 'max' => 8],
            [['name_okved'], 'string', 'max' => 65],
            [['kod_okved'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_okved' => 'Id Okved',
            'kod_okved' => 'Kod Okved',
            'name_okved' => 'Name Okved',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_okved' => 'id_okved']);
    }
}
