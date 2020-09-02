<?php

use app\models\tables\TipOrganisation;
use app\models\tables\VidOrganisation;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Organisation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-form">

    <?php $form = ActiveForm::begin([
        'id' => 'organisation-form',
    ]); ?>

    <?= $form->field($model, 'reg_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tip')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TipOrganisation::find()
            ->select(['id_tip', 'concat(kod_tip, " ", name_tip) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_tip', 'value'),
        'options' => ['placeholder' => 'Выберите тип организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_vid')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(VidOrganisation::find()
            ->select(['id_vid', 'concat(kod_vid, " ", name_vid) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_vid', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    echo Select2::widget([
        'model' => $model,
        'attribute' => 'id_vid',
        'data' => ArrayHelper::map(VidOrganisation::find()
            ->select(['id_vid', 'concat(kod_vid, " ", name_vid) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_vid', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?php /*$form->field($model, 'id_okved')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okved::find()
            ->select(['id_okved', 'concat(kod_okved, " ", name_okved) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okved', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>
    <?= $form->field($model, 'id_okato')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okato::find()
            ->select(['id_okato', 'concat(kod_okato, " ", name_okato) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okato', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= $form->field($model, 'id_oktmo')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Oktmo::find()
            ->select(['id_oktmo', 'concat(kod_oktmo, " ", name_oktmo) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_oktmo', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= $form->field($model, 'id_okfs')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\VidSob::find()
            ->select(['id_okfs', 'concat(kod_okfs, " ", name_okfs) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okfs', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= $form->field($model, 'id_okopf')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okopf::find()
            ->select(['id_okopf', 'concat(kod_okopf, " ", name_okopf) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okopf', 'value'),
        'options' => ['placeholder' => 'Выберите вид организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);*/ ?>

    <?= $form->field($model, 'id_owner')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Owner::find()
            ->select(['id_owner', 'concat(reg_num, " ", name) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_owner', 'value'),
        'options' => ['placeholder' => 'Выберите учредителя ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
