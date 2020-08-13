<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "model".
 *
 * @property int $id_mod
 * @property int $kod_mod
 * @property string $name_mod
 *
 * @property Dmu[] $dmus
 */
class Model extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_mod'], 'required'],
            [['kod_mod'], 'integer'],
            [['name_mod'], 'string', 'max' => 65],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mod' => 'Номер записи',
            'kod_mod' => 'Код модели',
            'name_mod' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['id_mod' => 'id_mod']);
    }
}
