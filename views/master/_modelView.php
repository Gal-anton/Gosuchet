<?php

use app\models\tables\Model;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\Master */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="master_model">

    <?php
    $form = ActiveForm::begin([
        'id' => 'master_model',
        'action' => \yii\helpers\Url::toRoute(['master/model']),
        'method' => 'get',
        'enableAjaxValidation' => false,
    ]);
    ?>
    <?php
    echo Select2::widget([
        'name' => 'model',
        'data' => ArrayHelper::map(Model::find()
            ->select(['kod_mod', 'concat(kod_mod, " ", name_mod) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'kod_mod', 'value'),
        'value' => $model->id_mod,
        'options' => [
            'placeholder' => 'Выберите модель ...',
            'multiple' => false
        ],
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form->end(); ?>
</div>
