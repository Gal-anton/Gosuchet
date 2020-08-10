<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ppo".
 *
 * @property int $id_ppo
 * @property int $kod_ppo
 * @property string $name_ppo
 *
 * @property Organisation $organisation
 */
class Ppo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_ppo'], 'required'],
            [['kod_ppo'], 'integer'],
            [['name_ppo'], 'string', 'max' => 65],
            [['kod_ppo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ppo' => 'Id Ppo',
            'kod_ppo' => 'Kod Ppo',
            'name_ppo' => 'Name Ppo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisation::className(), ['kod_ppo' => 'id_ppo']);
    }
}
