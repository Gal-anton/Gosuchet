<?php

namespace app\models\tables;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "okopf".
 *
 * @property int $id_okopf
 * @property int $kod_okopf
 * @property string $name_okopf
 *
 * @property Organisation[] $organisations
 */
class Okopf extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'okopf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_okopf'], 'required'],
            [['kod_okopf'], 'integer'],
            [['name_okopf'], 'string', 'max' => 255],
            [['kod_okopf'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_okopf' => 'Номер записи',
            'kod_okopf' => 'Код ОКОПФ',
            'name_okopf' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_okopf' => 'id_okopf']);
    }
}
