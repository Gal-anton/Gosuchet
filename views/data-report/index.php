<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\DataReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчетные данные';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать отчет', Url::to(['organisation/']), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_data_report',
            'id_org',
            'report_year',
            'report_staff_plan',
            'report_staff_fact',
            //'report_sum_fin',
            //'report_sum_fot',
            //'id_orgstr',
            //'id_fun',
            //'resource_sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
