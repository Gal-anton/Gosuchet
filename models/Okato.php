<?php

namespace app\models;

/**
 * This is the model class for table "okato".
 *
 * @property int $id_okato
 * @property string $kod_okato
 * @property string $name_okato
 *
 * @property Organisation[] $organisations
 */
class Okato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'okato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_okato'], 'required'],
            [['kod_okato'], 'string', 'max' => 11],
            [['name_okato'], 'string', 'max' => 255],
            [['kod_okato'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_okato' => 'Id Okato',
            'kod_okato' => 'Kod Okato',
            'name_okato' => 'Name Okato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_okato' => 'id_okato']);
    }
}
