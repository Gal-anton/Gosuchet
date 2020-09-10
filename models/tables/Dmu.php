<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

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
            [['dmu_dmu', 'criteria_id_org', 'level_search', 'id_fun', 'id_mod', 'id_input', 'id_output'], 'required'],
            [['criteria_id_org', 'vid_org', 'level_search', 'id_fun', 'id_mod', 'id_input', 'sum_input', 'id_output', 'sum_output'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['efficency'], 'double'],
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
            'efficency' => 'Общая неэффективность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'level_search' => 'Уровень поиска',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_dmu' => 'id_dmu']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCriteriaIdOrg()
    {
        if ($this->id_mod == "1") {
            return $this->hasOne(Organisation::className(), ['id_org' => 'criteria_id_org']);
        }
        return $this->hasOne(Owner::className(), ['id_owner' => 'criteria_id_org']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLevelSearch()
    {
        return $this->hasOne(Level::className(), ['id_level' => 'level_search']);
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
    public function getVidOrg()
    {
        return $this->hasOne(VidOrganisation::className(), ['id_vid' => 'vid_org']);
    }

    /**
     * @return ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_dmu' => 'id_dmu']);
    }

    /**
     * @return array|false
     */
    public function getSimilarOrg()
    {
        $organisations = false;
        if ($this->id_mod == 1) {
            $organisations = $this->getSimilarOrgByOrg();
        } else if ($this->id_mod == 2) {
            $organisations = $this->getSimilarOrgByOwner();
        }
        return $organisations;
    }

    /**
     * @return ActiveDataProvider
     */
    private function getSimilarOrgByOrg()
    {
        $organisationCriteria = $this->criteriaIdOrg;
        $kod_oktmo = (isset($organisationCriteria->oktmo) === true) ? $organisationCriteria->oktmo->kod_oktmo : "";

        $query = new Query();
        $subQuery = new Query();
        $query->select('*')
            ->from(Organisation::tableName())
            ->andWhere(['id_tip' => $organisationCriteria->id_tip])
            ->andWhere(['id_vid' => $organisationCriteria->id_vid])
            ->andWhere(['id_okfs' => $organisationCriteria->id_okfs])
            ->innerJoin(Oktmo::tableName(),
                Organisation::tableName() . '.id_oktmo = ' . Oktmo::tableName() . '.id_oktmo')
            ->andWhere(['like', Oktmo::tableName() . '.kod_oktmo',
                $this->getOktmoSearch($this->level_search, $kod_oktmo) . "%", false])
            ->all();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }

    /**
     * @return ActiveDataProvider
     */
    private function getSimilarOrgByOwner()
    {
        $owner = $this->criteriaIdOrg;
        $organisationCriteria = $owner->organisations[0];
        $kod_oktmo = (isset($organisationCriteria->oktmo) === true) ? $organisationCriteria->oktmo->kod_oktmo : "";
        $ownerCriteria = $this->criteria_id_org;

        $query = new Query();
        $query->select('*')
            ->from(Organisation::tableName())
            ->andWhere(['id_owner' => $ownerCriteria])
            ->andWhere(['id_vid' => $this->vid_org])
            ->innerJoin(Oktmo::tableName(),
                Organisation::tableName() . '.id_oktmo = ' . Oktmo::tableName() . '.id_oktmo')
            ->andWhere(['like', Oktmo::tableName() . '.kod_oktmo',
                $this->getOktmoSearch($this->level_search, $kod_oktmo) . "%", false])
            ->all();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }

    private function getOktmoSearch($level_search, $kod_oktmo = "")
    {
        $search = "";
        switch ($level_search) {
            case "1":
                $search = substr($kod_oktmo, 0, 2);
                break;
            case "2":
                $search = substr($kod_oktmo, 0, 5);
                break;
            case "3":
                $search = substr($kod_oktmo, 0, 8);
                break;
            default;
        }
        return $search;
    }
}
