<?php

use app\models\tables\Inputs;
use app\models\tables\Level;
use app\models\tables\OrgFunction;
use app\models\tables\Outputs;
use app\models\tables\VidOrganisation;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dmu-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'dmu_dmu')->textInput() ?>

    <?= $form->field($model, 'id_fun')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(OrgFunction::find()
            ->select(['id_fun', 'concat(kod_fun, " ", name_fun) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_fun', 'value'),
        'options' => ['placeholder' => 'Выберите функцию ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?php
    if ($model->id_mod == 2) {
        echo $form->field($model, 'vid_org')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(VidOrganisation::find()
                ->select(['id_vid', 'name_vid as value'])
                ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_vid', 'value'),
            'options' => ['placeholder' => 'Выберите вид организации ...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    }
    ?>

    <?= $form->field($model, 'level_search')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Level::find()
            ->select(['id_level', 'name_level as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_level', 'value'),
        'options' => ['placeholder' => 'Выберите уровень агрегации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_input')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Inputs::find()
            ->select(['id_input', 'name_input as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_input', 'value'),
        'options' => ['placeholder' => 'Выберите тип ресурса ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_output')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Outputs::find()
            ->select(['id_output', 'name_output as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_output', 'value'),
        'options' => ['placeholder' => 'Выберите тип результата ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'criteria_id_org')->hiddenInput(['value' => $model->criteria_id_org])->label(false); ?>
    <?= $form->field($model, 'id_mod')->hiddenInput(['value' => $model->id_mod])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
