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

}
