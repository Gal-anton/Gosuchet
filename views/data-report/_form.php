<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\DataReport */
/* @var $form yii\widgets\ActiveForm */
/* @var $id_org string */
/* @var $orgName string */
$id_org = (isset($id_org) === true) ? $id_org : $model->id_org;
?>

<div class="data-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_org')->textInput(['value' => $id_org]) ?>
    <?= '<p>' . $orgName . '</p>' ?>

    <?= $form->field($model, 'report_year')->textInput(['']) ?>

    <?= $form->field($model, 'report_staff_plan')->textInput() ?>

    <?= $form->field($model, 'report_staff_fact')->textInput() ?>

    <?= $form->field($model, 'report_sum_fin')->textInput() ?>

    <?= $form->field($model, 'report_sum_fot')->textInput() ?>

    <?= $form->field($model, 'id_orgstr')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Orgstruct::find()
            ->select(['id_orgstr', 'concat(kod_orgstr, " ", name_orgstr) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_orgstr', 'value'),
        'options' => ['placeholder' => 'Выберите орг структуру ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_fun')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\OrgFunction::find()
            ->select(['id_fun', 'concat(kod_fun, " ", name_fun) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_fun', 'value'),
        'options' => ['placeholder' => 'Выберите функцию ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'resource_sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
