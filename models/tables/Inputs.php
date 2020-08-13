<?php

namespace app\models\tables;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "inputs".
 *
 * @property int $id_input
 * @property int $kod_input
 * @property string $name_input
 * @property int $id_fun
 *
 * @property Dmu[] $dmus
 * @property OrgFunction $fun
 */
class Inputs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_input', 'name_input', 'id_fun'], 'required'],
            [['kod_input', 'id_fun'], 'integer'],
            [['name_input'], 'string', 'max' => 65],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => OrgFunction::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_input' => 'Номер записи',
            'kod_input' => 'Код данных',
            'name_input' => 'Наименование',
            'id_fun' => 'Функция',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['id_input' => 'id_input']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }
}
