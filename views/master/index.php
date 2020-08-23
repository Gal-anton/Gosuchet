<?php

use app\models\Master;
use app\models\tables\Model;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Master */

?>
<h1>Мастер оценки</h1>
<?php
$form = ActiveForm::begin([
    'id' => 'master_model',
    'action' => \yii\helpers\Url::toRoute(['master/test']),
    'method' => 'post',
    'enableAjaxValidation' => false,
]);
var_dump(ArrayHelper::map(Model::find()
    ->select(['id_mod', 'concat(kod_mod, " ", name_mod) as value'])
    ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_mod', 'value'));
?>

<?= $form->field($model, 'id_model')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Model::find()
        ->select(['id_mod', 'concat(kod_mod, " ", name_mod) as value'])
        ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_mod', 'value'),
    'options' => ['placeholder' => 'Выберите модель ...'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>
<?= Html::submitButton('Выбрать'); ?>
<?php $form->end(); ?>

<!-- Ответ сервера будем выводить сюда -->
<p id="output"></p>
