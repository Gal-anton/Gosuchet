<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "organisation".
 *
 * @property int $id_org
 * @property string $reg_num
 * @property string $full_name
 * @property string $short_name
 * @property string $inn
 * @property string $ppo
 * @property int $id_tip
 * @property int $id_vid
 * @property int $id_okved
 * @property int $id_okato
 * @property int $id_oktmo
 * @property int $id_okfs
 * @property int $id_buj
 * @property int $id_okopf
 * @property int $id_owner
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DataReport[] $dataReports
 * @property Okopf $okopf
 * @property TipOrganisation $tip
 * @property Okved $okved
 * @property Okato $okato
 * @property VidOrganisation $idV
 * @property VidSob $okfs
 * @property Oktmo $oktmo
 * @property Owner $owner
 */
class Organisation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisation';
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
            [['reg_num', 'full_name', 'inn', 'id_tip', 'id_vid', 'id_okved', 'id_okfs', 'id_okopf'], 'required'],
            [['full_name'], 'string'],
            [['id_tip', 'id_vid', 'id_okved', 'id_okato', 'id_oktmo', 'id_okfs', 'id_buj', 'id_okopf', 'id_owner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['reg_num'], 'string', 'max' => 15],
            [['short_name', 'ppo'], 'string', 'max' => 255],
            [['inn'], 'string', 'max' => 11],
            [['reg_num'], 'unique'],
            [['inn'], 'unique'],
            [['id_okopf'], 'exist', 'skipOnError' => true, 'targetClass' => Okopf::className(), 'targetAttribute' => ['id_okopf' => 'id_okopf']],
            [['id_tip'], 'exist', 'skipOnError' => true, 'targetClass' => TipOrganisation::className(), 'targetAttribute' => ['id_tip' => 'id_tip']],
            [['id_okved'], 'exist', 'skipOnError' => true, 'targetClass' => Okved::className(), 'targetAttribute' => ['id_okved' => 'id_okved']],
            [['id_okato'], 'exist', 'skipOnError' => true, 'targetClass' => Okato::className(), 'targetAttribute' => ['id_okato' => 'id_okato']],
            [['id_vid'], 'exist', 'skipOnError' => true, 'targetClass' => VidOrganisation::className(), 'targetAttribute' => ['id_vid' => 'id_vid']],
            [['id_okfs'], 'exist', 'skipOnError' => true, 'targetClass' => VidSob::className(), 'targetAttribute' => ['id_okfs' => 'id_okfs']],
            [['id_oktmo'], 'exist', 'skipOnError' => true, 'targetClass' => Oktmo::className(), 'targetAttribute' => ['id_oktmo' => 'id_oktmo']],
            [['id_owner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['id_owner' => 'id_owner']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_org' => 'Номер записи',
            'reg_num' => 'Регистрационный номер',
            'full_name' => 'Полное имя',
            'short_name' => 'Сокращенное наименование',
            'inn' => 'ИНН',
            'ppo' => 'ППО',
            'id_tip' => 'Тип организации',
            'id_vid' => 'Вид организации',
            'id_okved' => 'ОКВЕД',
            'id_okato' => 'ОКАТО',
            'id_oktmo' => 'ОКТМО',
            'id_okfs' => 'ОКФС',
            'id_buj' => 'Бюджет',
            'id_okopf' => 'ОКОПФ',
            'id_owner' => 'Учредитель',
            'created_at' => 'Создание записи',
            'updated_at' => 'Изменение записи',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->id_buj = $this->idV->kod_vid;

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataReports()
    {
        return $this->hasMany(DataReport::className(), ['id_org' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkopf()
    {
        return $this->hasOne(Okopf::className(), ['id_okopf' => 'id_okopf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTip()
    {
        return $this->hasOne(TipOrganisation::className(), ['id_tip' => 'id_tip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkved()
    {
        return $this->hasOne(Okved::className(), ['id_okved' => 'id_okved']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkato()
    {
        return $this->hasOne(Okato::className(), ['id_okato' => 'id_okato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdV()
    {
        return $this->hasOne(VidOrganisation::className(), ['id_vid' => 'id_vid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkfs()
    {
        return $this->hasOne(VidSob::className(), ['id_okfs' => 'id_okfs']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOktmo()
    {
        return $this->hasOne(Oktmo::className(), ['id_oktmo' => 'id_oktmo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner::className(), ['id_owner' => 'id_owner']);
    }
}
