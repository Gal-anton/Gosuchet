<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "dmu".
 *
 * @property int $id_dmu
 * @property string $dmu_dmu
 * @property int $id_fun
 * @property int $id_mod
 * @property int $id_input
 * @property int $sum_input
 * @property int $id_output
 * @property int $sum_output
 * @property int $efficency
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OrgFunction $fun
 * @property Inputs $input
 * @property Model $mod
 * @property Outputs $output
 * @property Journal[] $journals
 */
class Dmu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dmu';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dmu_dmu', 'id_fun', 'id_mod', 'id_input', 'id_output'], 'required'],
            [['id_fun', 'id_mod', 'id_input', 'sum_input', 'id_output', 'sum_output', 'efficency'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['dmu_dmu'], 'string', 'max' => 65],
            [['id_fun'], 'exist', 'skipOnError' => true, 'targetClass' => OrgFunction::className(), 'targetAttribute' => ['id_fun' => 'id_fun']],
            [['id_input'], 'exist', 'skipOnError' => true, 'targetClass' => Inputs::className(), 'targetAttribute' => ['id_input' => 'id_input']],
            [['id_mod'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['id_mod' => 'id_mod']],
            [['id_output'], 'exist', 'skipOnError' => true, 'targetClass' => Outputs::className(), 'targetAttribute' => ['id_output' => 'id_output']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dmu' => 'Номер записи',
            'dmu_dmu' => 'Наименование',
            'id_fun' => 'Функция',
            'id_mod' => 'Модель',
            'id_input' => 'Входные данные',
            'sum_input' => 'Сумма входа',
            'id_output' => 'Выходные данные',
            'sum_output' => 'Сумма выхода',
            'efficency' => 'Эффективность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return ActiveQuery
     */
    public function getInput()
    {
        return $this->hasOne(Inputs::className(), ['id_input' => 'id_input']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Model::className(), ['id_mod' => 'id_mod']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOutput()
    {
        return $this->hasOne(Outputs::className(), ['id_output' => 'id_output']);
    }

    /**
     * @return ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_dmu' => 'id_dmu']);
    }
}
