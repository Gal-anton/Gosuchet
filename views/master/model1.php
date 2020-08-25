<?php

use app\models\Master;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Master */
/* @var $searchModel app\models\search\OrganisationSearch */
/* @var $orgData yii\data\ActiveDataProvider */

?>
    <h1>Мастер оценки</h1>
<?php echo $this->render('_modelView', ['model' => $model]); ?>

<?php
//echo $this->render('_searchOrg', ['model' => $searchModel]);
?>
    <div class="master_data">

<?php
$form = ActiveForm::begin([
    'id' => 'master_data',
    'action' => \yii\helpers\Url::toRoute(['master/organisations']),
    'method' => 'post',
    'enableAjaxValidation' => false,
]);
?>
<?php
echo $this->render('_searchOrg', ['model' => $searchModel]);
echo GridView::widget([
    'dataProvider' => $orgData,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'reg_num',
        'inn',
        'full_name:ntext',
        'short_name',
        //['attribute' => 'tip_name','label' => 'Тип', 'value'=>'tip.name_tip'],
        'ppo',
        //'id_tip',
        //'id_vid',
        //'id_okved',
        //'id_okato',
        //'id_oktmo',
        //'id_okfs',
        //'id_buj',
        //'id_okopf',
        //'id_owner',
        ['label' => 'Отчеты',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::radioList('abc', null, [$data->id_org => ""], ['class' => 'form-control input-sm radio']);
            }],


    ],
]);
?>

<?php
echo '<label class="control-label">Выберите масштаб:</label>';
echo Select2::widget([
    'name' => 'model',
    'data' => ArrayHelper::map(\app\models\tables\Organisation::find()
        ->select(['id_org', 'concat(reg_num, " ", full_name) as value'])
        ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_org', 'value'),
    'options' => [
        'placeholder' => 'Выберите организацию ...',
        'multiple' => false
    ],
])
?>


<?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']); ?>
<?php $form->end(); ?>