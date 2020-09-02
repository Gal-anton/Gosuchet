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
<?php echo $this->render('_modelView', ['model' => $model]); ?>

    <div class="master_model">

<?php
$form = ActiveForm::begin([
    'id' => 'master_data',
    'action' => \yii\helpers\Url::toRoute(['master/organisations']),
    'method' => 'post',
    'enableAjaxValidation' => false,
]);
?>
<?php
echo Select2::widget([
    'name' => 'model',
    'data' => ArrayHelper::map(Model::find()
        ->select(['id_mod', 'concat(kod_mod, " ", name_mod) as value'])
        ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_mod', 'value'),
    'options' => [
        'placeholder' => 'Выберите модель ...',
        'multiple' => false
    ],
])
?>

<?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']); ?>
<?php $form->end(); ?>