<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "vid_sob".
 *
 * @property int $id_okfs
 * @property int $kod_okfs
 * @property string $name_okfs
 *
 * @property Organisation[] $organisations
 */
class VidSob extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vid_sob';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_okfs'], 'required'],
            [['kod_okfs'], 'integer'],
            [['name_okfs'], 'string', 'max' => 65],
            [['kod_okfs'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_okfs' => 'Номер записи',
            'kod_okfs' => 'Код ОКФС',
            'name_okfs' => 'Вид собственности',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_okfs' => 'id_okfs']);
    }
}
