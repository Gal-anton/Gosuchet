<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisation".
 *
 * @property int $id_org
 * @property int $reg_num
 * @property string $full_name
 * @property string $short_name
 * @property int $inn
 * @property int $kod_ppo
 * @property int $id_tip
 * @property int $id_vid
 * @property int $id_okved
 * @property int $id_okato
 * @property int $id_oktmo
 * @property int $id_okfs
 * @property int $id_buj
 * @property int $id_okopf
 * @property string $id_owner
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
 * @property Ppo $kodPpo
 * @property Bujet $buj
 * @property Oktmo $oktmo
 */
class Organisation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_num', 'full_name', 'short_name', 'inn', 'kod_ppo', 'id_tip', 'id_vid', 'id_okved', 'id_okato', 'id_oktmo', 'id_okfs', 'id_buj', 'id_okopf', 'created_at', 'updated_at'], 'required'],
            [['reg_num', 'inn', 'kod_ppo', 'id_tip', 'id_vid', 'id_okved', 'id_okato', 'id_oktmo', 'id_okfs', 'id_buj', 'id_okopf'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name'], 'string', 'max' => 255],
            [['short_name', 'id_owner'], 'string', 'max' => 65],
            [['kod_ppo'], 'unique'],
            [['id_okopf'], 'exist', 'skipOnError' => true, 'targetClass' => Okopf::className(), 'targetAttribute' => ['id_okopf' => 'id_okopf']],
            [['id_tip'], 'exist', 'skipOnError' => true, 'targetClass' => TipOrganisation::className(), 'targetAttribute' => ['id_tip' => 'id_tip']],
            [['id_okved'], 'exist', 'skipOnError' => true, 'targetClass' => Okved::className(), 'targetAttribute' => ['id_okved' => 'id_okved']],
            [['id_okato'], 'exist', 'skipOnError' => true, 'targetClass' => Okato::className(), 'targetAttribute' => ['id_okato' => 'id_okato']],
            [['id_vid'], 'exist', 'skipOnError' => true, 'targetClass' => VidOrganisation::className(), 'targetAttribute' => ['id_vid' => 'id_vid']],
            [['id_okfs'], 'exist', 'skipOnError' => true, 'targetClass' => VidSob::className(), 'targetAttribute' => ['id_okfs' => 'id_okfs']],
            [['kod_ppo'], 'exist', 'skipOnError' => true, 'targetClass' => Ppo::className(), 'targetAttribute' => ['kod_ppo' => 'id_ppo']],
            [['id_buj'], 'exist', 'skipOnError' => true, 'targetClass' => Bujet::className(), 'targetAttribute' => ['id_buj' => 'id_buj']],
            [['id_oktmo'], 'exist', 'skipOnError' => true, 'targetClass' => Oktmo::className(), 'targetAttribute' => ['id_oktmo' => 'id_oktmo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_org' => 'Id Org',
            'reg_num' => 'Reg Num',
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'inn' => 'Inn',
            'kod_ppo' => 'Kod Ppo',
            'id_tip' => 'Id Tip',
            'id_vid' => 'Id Vid',
            'id_okved' => 'Id Okved',
            'id_okato' => 'Id Okato',
            'id_oktmo' => 'Id Oktmo',
            'id_okfs' => 'Id Okfs',
            'id_buj' => 'Id Buj',
            'id_okopf' => 'Id Okopf',
            'id_owner' => 'Id Owner',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getKodPpo()
    {
        return $this->hasOne(Ppo::className(), ['id_ppo' => 'kod_ppo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuj()
    {
        return $this->hasOne(Bujet::className(), ['id_buj' => 'id_buj']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOktmo()
    {
        return $this->hasOne(Oktmo::className(), ['id_oktmo' => 'id_oktmo']);
    }
}
