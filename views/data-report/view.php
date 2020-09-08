<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\DataReport */

$this->title = $model->id_data_report;
$this->params['breadcrumbs'][] = ['label' => 'Данные организаций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_data_report], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Удалить', ['delete', 'id' => $model->id_data_report], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_data_report',
            ['attribute' => 'name_org', 'label' => 'Организации',
                'value' => function ($model) {
                    return $model->org->reg_num . " " . $model->org->short_name;
                },],
            ['attribute' => 'dmu_dmu', 'label' => 'DMU',
                'value' => function ($model) {
                    return $model->dmu->id_dmu . " " . $model->dmu->dmu_dmu;
                },],
            ['attribute' => 'name_orgstr', 'label' => 'Структура',
                'value' => function ($model) {
                    return (isset($model->orgstr) === true) ?
                        $model->orgstr->kod_orgstr . " " . $model->orgstr->name_orgstr :
                        "Не установлено";
                },],
            //'id_org',
            //'id_dmu',
            //'id_orgstr',
            'input',
            'output',
            'efficency',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
