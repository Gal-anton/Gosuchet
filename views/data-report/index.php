<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DataReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Данные организации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Data Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_data_report',
            //'id_org',
            ['attribute' => 'name_org', 'label' => 'Организация', 'value' => 'org.short_name'],
            //'id_dmu',
            ['attribute' => 'dmu_dmu', 'label' => 'DMU', 'value' => 'dmu.dmu_dmu'],
            //'id_orgstr',
            ['attribute' => 'name_orgstr', 'label' => 'Структура', 'value' => 'orgstr.name_orgstr'],
            'input',
            'output',
            'efficency',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'],
        ],
    ]); ?>
</div>
