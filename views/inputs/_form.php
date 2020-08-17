<?php

use app\models\tables\OrgFunction;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Inputs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inputs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_input')->textInput() ?>

    <?= $form->field($model, 'name_input')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_fun')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(OrgFunction::find()
            ->select(['id_fun', 'concat(kod_fun, " ", name_fun) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_fun', 'value'),
        'options' => ['placeholder' => 'Выберите функцию ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
