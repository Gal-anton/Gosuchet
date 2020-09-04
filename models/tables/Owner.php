<?php

namespace app\models\tables;

/**
 * This is the model class for table "owner".
 *
 * @property int $id_owner
 * @property int $reg_num
 * @property string $name
 *
 * @property Organisation[] $organisations
 * @property Organisation $organisation
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reg_num', 'name'], 'required'],
            [['reg_num'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['reg_num'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_owner' => 'Запись',
            'reg_num' => 'Регистрационный номер',
            'name' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_owner' => 'id_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisation::className(), ['reg_num' => 'reg_num']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTip()
    {
        return $this->hasOne(TipOrganisation::className(), ['id_tip' => 'id_tip'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkopf()
    {
        return $this->hasOne(Okopf::className(), ['id_okopf' => 'id_okopf'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkved()
    {
        return $this->hasOne(Okved::className(), ['id_okved' => 'id_okved'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkato()
    {
        return $this->hasOne(Okato::className(), ['id_okato' => 'id_okato'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdV()
    {
        return $this->hasOne(VidOrganisation::className(), ['id_vid' => 'id_vid'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOkfs()
    {
        return $this->hasOne(VidSob::className(), ['id_okfs' => 'id_okfs'])->via('organisation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOktmo()
    {
        return $this->hasOne(Oktmo::className(), ['id_oktmo' => 'id_oktmo'])->via('organisation');
    }
}
