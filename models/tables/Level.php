<?php

namespace app\models\tables;

/**
 * This is the model class for table "level".
 *
 * @property int $id_level
 * @property string $name_level
 *
 * @property Dmu[] $dmus
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_level'], 'required'],
            [['name_level'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_level' => 'Id Level',
            'name_level' => 'Name Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDmus()
    {
        return $this->hasMany(Dmu::className(), ['level_search' => 'id_level']);
    }
}
