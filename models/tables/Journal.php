<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "journal".
 *
 * @property int $id_j
 * @property int $id_dmu
 * @property int $minX
 * @property int $maxX
 * @property int $minY
 * @property int $maxY
 * @property int $un_efficency
 * @property string $created_at
 *
 * @property Dmu $dmu
 */
class Journal extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'journal';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
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
            [['id_dmu', 'minX', 'maxX', 'minY', 'maxY', 'un_efficency'], 'required'],
            [['id_dmu', 'minX', 'maxX', 'minY', 'maxY'], 'integer'],
            [['un_efficency'], 'double'],
            [['created_at'], 'safe'],
            [['id_dmu'], 'exist', 'skipOnError' => true, 'targetClass' => Dmu::className(), 'targetAttribute' => ['id_dmu' => 'id_dmu']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_j' => 'Номер записи',
            'id_dmu' => 'DMU',
            'minX' => 'Минимальный X',
            'maxX' => 'Максимальный X',
            'minY' => 'Минимальный Y',
            'maxY' => 'Минимальный Y',
            'un_efficency' => 'Неэффективность',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDmu()
    {
        return $this->hasOne(Dmu::className(), ['id_dmu' => 'id_dmu']);
    }
}
