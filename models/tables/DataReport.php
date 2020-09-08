<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "data_report".
 *
 * @property int $id_data_report
 * @property int $id_org
 * @property int $id_dmu
 * @property int $id_orgstr
 * @property int $input
 * @property int $output
 * @property int $efficency
 * @property string $created_at
 * @property string $updated_at
 * @property array $formAttribs
 *
 * @property Organisation $org
 * @property Orgstruct $orgstr
 * @property Dmu $dmu
 */
class DataReport extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_report';
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
            [['id_org', 'id_dmu'], 'required'],
            [['id_org', 'id_dmu', 'id_orgstr', 'input', 'output', 'efficency'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => Organisation::className(), 'targetAttribute' => ['id_org' => 'id_org']],
            [['id_orgstr'], 'exist', 'skipOnError' => true, 'targetClass' => Orgstruct::className(), 'targetAttribute' => ['id_orgstr' => 'id_orgstr']],
            [['id_dmu'], 'exist', 'skipOnError' => true, 'targetClass' => Dmu::className(), 'targetAttribute' => ['id_dmu' => 'id_dmu']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_data_report' => 'Номер записи',
            'id_org' => 'Организация',
            'id_dmu' => 'DMU',
            'id_orgstr' => 'Оргструктура',
            'input' => 'Ресурс',
            'output' => 'Результат',
            'efficency' => 'Эффективность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organisation::className(), ['id_org' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgstr()
    {
        return $this->hasOne(Orgstruct::className(), ['id_orgstr' => 'id_orgstr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDmu()
    {
        return $this->hasOne(Dmu::className(), ['id_dmu' => 'id_dmu']);
    }

}
