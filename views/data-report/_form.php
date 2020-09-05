<?php

use app\models\tables\Organisation;
use app\models\tables\Orgstruct;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\DataReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo '<h2>' . Organisation::findOne($model->id_org)->short_name . '</h2>';
    //$form->field($model, 'id_org')->textInput() ?>

    <?php //$form->field($model, 'id_dmu')->textInput() ?>

    <?= $form->field($model, 'id_orgstr')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Orgstruct::find()
            ->select(['id_orgstr', 'concat(kod_orgstr, " ", name_orgstr) as value'])
            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_orgstr', 'value'),
        'options' => ['placeholder' => 'Выберите структуру организации ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'input')->textInput() ?>

    <?= $form->field($model, 'output')->textInput() ?>

    <?php //$form->field($model, 'efficency')->textInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
