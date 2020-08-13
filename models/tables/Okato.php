<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "okato".
 *
 * @property int $id_okato
 * @property string $kod_okato
 * @property string $name_okato
 *
 * @property Organisation[] $organisations
 */
class Okato extends ActiveRecord
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
            'id_okato' => 'Номер записи',
            'kod_okato' => 'Код ОКАТО',
            'name_okato' => 'Наименование',
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
