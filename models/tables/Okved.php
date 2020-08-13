<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "okved".
 *
 * @property int $id_okved
 * @property string $kod_okved
 * @property string $name_okved
 *
 * @property Organisation[] $organisations
 */
class Okved extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'okved';
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
            [['kod_okved'], 'required'],
            [['kod_okved'], 'string', 'max' => 8],
            [['name_okved'], 'string', 'max' => 255],
            [['kod_okved'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_okved' => 'Номер записи',
            'kod_okved' => 'Код ОКВЕД',
            'name_okved' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisations()
    {
        return $this->hasMany(Organisation::className(), ['id_okved' => 'id_okved']);
    }
}
