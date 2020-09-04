<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "dmu".
 *
 * @property int $id_dmu
 * @property string $dmu_dmu
 * @property int $criteria_id_org
 * @property int $level_search
 * @property int $vid_org
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
 * @property DataReport[] $dataReports
 * @property Organisation|Owner $criteriaIdOrg
 * @property Level $levelSearch
 * @property OrgFunction $fun
 * @property Inputs $input
 * @property Model $mod
 * @property VidOrganisation $vidOrg
 * @property Outputs $output
 * @property Journal[] $journals
 */
class Dmu extends \yii\db\ActiveRecord
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
            [['dmu_dmu', 'criteria_id_org', 'level_search', 'id_fun', 'id_mod', 'id_input', 'id_output'], 'required'],
            [['criteria_id_org', 'vid_org', 'level_search', 'id_fun', 'id_mod', 'id_input', 'sum_input', 'id_output', 'sum_output', 'efficency'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['dmu_dmu'], 'string', 'max' => 65],
            [['criteria_id_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organisation::className(), 'targetAttribute' => ['criteria_id_org' => 'id_org']],
            [['level_search'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_search' => 'id_level']],
            [['vid_org'], 'exist', 'skipOnError' => true, 'targetClass' => VidOrganisation::className(), 'targetAttribute' => ['vid_org' => 'id_vid']],
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
            'criteria_id_org' => 'Код критерия для группировки',
            'vid_org' => 'Вид организации',
            'id_fun' => 'Функция',
            'id_mod' => 'Модель',
            'id_input' => 'Входные данные',
            'sum_input' => 'Сумма входа',
            'id_output' => 'Выходные данные',
            'sum_output' => 'Сумма выхода',
            'efficency' => 'Эффективность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'level_search' => 'Уровень поиска',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_dmu' => 'id_dmu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriaIdOrg()
    {
        if ($this->id_mod == "1") {
            return $this->hasOne(Organisation::className(), ['id_org' => 'criteria_id_org']);
        }
        return $this->hasOne(Owner::className(), ['id_owner' => 'criteria_id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelSearch()
    {
        return $this->hasOne(Level::className(), ['id_level' => 'level_search']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(OrgFunction::className(), ['id_fun' => 'id_fun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInput()
    {
        return $this->hasOne(Inputs::className(), ['id_input' => 'id_input']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod()
    {
        return $this->hasOne(Model::className(), ['id_mod' => 'id_mod']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutput()
    {
        return $this->hasOne(Outputs::className(), ['id_output' => 'id_output']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidOrg()
    {
        return $this->hasOne(VidOrganisation::className(), ['id_vid' => 'vid_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_dmu' => 'id_dmu']);
    }
}
