<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vid_organisation".
 *
 * @property int $id_vid
 * @property int $kod_vid
 * @property string $name_vid
 *
 * @property Organisation[] $organisations
 */
class VidOrganisation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vid_organisation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_vid'], 'required'],
            [['kod_vid'], 'integer'],
            [['name_vid'], 'string', 'max' => 255],
            [['kod_vid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_vid' => 'Номер записи',
            'kod_vid' => 'Код вида организации',
            'name_vid' => 'Наименование',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_vid' => 'id_vid']);
    }
}
