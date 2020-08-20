<?php

namespace app\models\tables;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orgstruct".
 *
 * @property int $id_orgstr
 * @property int $kod_orgstr
 * @property string $name_orgstr
 * @property int $id_fun
 *
 * @property DataReport[] $dataReports
 * @property OrgFunction $fun
 */
class Orgstruct extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orgstruct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_orgstr', 'id_fun'], 'required'],
            [['id_fun'], 'integer'],
            [['kod_orgstr'], 'string', 'max' => 8],
            [['name_orgstr'], 'string', 'max' => 65],
            [['kod_orgstr'], 'unique'],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => OrgFunction::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_orgstr' => 'Номер записи',
            'kod_orgstr' => 'Код структуры',
            'name_orgstr' => 'Наименование',
            'id_fun' => 'Функция',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_orgstr' => 'id_orgstr']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }
}
