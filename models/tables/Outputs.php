<?php

namespace app\models\tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "outputs".
 *
 * @property int $id_output
 * @property int $kod_output
 * @property string $name_output
 * @property int $id_fun
 *
 * @property Dmu[] $dmus
 * @property OrgFunction $fun
 */
class Outputs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_output', 'name_output', 'id_fun'], 'required'],
            [['kod_output', 'id_fun'], 'integer'],
            [['name_output'], 'string', 'max' => 65],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => OrgFunction::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_output' => 'Номер записи',
            'kod_output' => 'Код данных',
            'name_output' => 'Наименование',
            'id_fun' => 'Функция',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['id_output' => 'id_output']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }
}
