<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\DataReport */

$this->title = $model->id_data_report;
$this->params['breadcrumbs'][] = ['label' => 'Data Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_data_report], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_data_report], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_data_report',
            'id_org',
            'report_year',
            'report_staff_plan',
            'report_staff_fact',
            'report_sum_fin',
            'report_sum_fot',
            'id_orgstr',
            'id_fun',
            'resource_sum',
        ],
    ]) ?>

</div>
