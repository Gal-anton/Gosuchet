<?php

use app\models\tables\TipOrganisation;
use app\models\tables\VidOrganisation;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\OrganisationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'reg_num') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'inn') ?>

    <?php echo $form->field($model, 'id_tip')->widget(Select2::classname(), [
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
    ]); ?>

    <?= $form->field($model, 'id_okved')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okved::find()
            ->select(['id_okved', 'concat(kod_okved, " ", name_okved) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okved', 'value'),
        'options' => ['placeholder' => 'Выберите ОКВЭД ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'id_okato')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okato::find()
            ->select(['id_okato', 'concat(kod_okato, " ", name_okato) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okato', 'value'),
        'options' => ['placeholder' => 'Выберите ОКАТО ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_oktmo')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Oktmo::find()
            ->select(['id_oktmo', 'concat(kod_oktmo, " ", name_oktmo) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_oktmo', 'value'),
        'options' => ['placeholder' => 'Выберите ОКТМО ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_okfs')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\VidSob::find()
            ->select(['id_okfs', 'concat(kod_okfs, " ", name_okfs) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okfs', 'value'),
        'options' => ['placeholder' => 'Выберите ОКФС ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_okopf')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\tables\Okopf::find()
            ->select(['id_okopf', 'concat(kod_okopf, " ", name_okopf) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_okopf', 'value'),
        'options' => ['placeholder' => 'Выберите ОКОПФ ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

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
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
