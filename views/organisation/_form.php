<?php

use app\models\tables\VidOrganisation;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Organisation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tip')->textInput() ?>

    <?= $form->field($model, 'id_vid')->widget(Select2::classname(), [
        'data' => VidOrganisation::find()
            ->select(['concat(kod_vid, " ", name_vid) as value'])
            ->orderBy(['value' => SORT_ASC])
            ->column(),
        'options' => ['placeholder' => 'Select Vid Organisation ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_okved')->textInput() ?>


    <?= $form->field($model, 'id_okato')->textInput() ?>

    <?= $form->field($model, 'id_oktmo')->textInput() ?>

    <?= $form->field($model, 'id_okfs')->textInput() ?>

    <?= $form->field($model, 'id_buj')->textInput() ?>

    <?= $form->field($model, 'id_okopf')->textInput() ?>

    <?= $form->field($model, 'id_owner')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
