<?php

namespace app\models;

use app\models\tables\Model;

/**
 * @property string $id_model
 *
 */
class Master extends Model
{
    public $id_model;
    public $id_org;

    public function rules()
    {
        return [
            [['id_model'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_model' => 'Номер записи',
            'id_org' => 'Организация',
        ];
    }

}