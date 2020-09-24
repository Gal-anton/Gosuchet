<?php

/* @var $this yii\web\View */
/* @var $model \app\models\tables\Dmu */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\DataReportSearch */
/* @var $labelNameFunction string */
/* @var $Xlabels string */
/* @var $min_g float */
/* @var $max_g float */
/* @var $YData string */
/* @var $XData string */
/* @var $YLine string */
/* @var $XLine string */
/* @var $title string */
/* @var $graphMin float */
/* @var $graphMax float */
/* @var $unitedData array */

/* @var $Arr array */

use phpnt\chartJS\ChartJs;
use yii\grid\GridView;

$this->title = $model->dmu_dmu;


$dataToDraw = [
    'datasets' => [
        [
            'data' => $unitedData,
            'index' => 1,
            'label' => "Результат",
            'fill' => false,
            'lineTension' => 0.1,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 5,
            'showLine' => false,
            'pointHitRadius' => 5,
            'spanGaps' => false,
            'order' => 1,
        ],
        [
            'data' => $Arr,
            'index' => 2,
            'label' => "Граница эффективности",
            'datalabels' => [
                'labels' => [
                    'title' => null
                ]
            ],
            'fill' => false,
            'lineTension' => 0,
            'backgroundColor' => 'red',
            'borderColor' => "red",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "red",
            'pointBackgroundColor' => "red",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "red",
            'pointHoverBorderColor' => "red",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ]
    ]
];

?>

    <h3><?php echo $this->title ?></h3>

    <h4><?= "Модель: " . $model->mod->name_mod ?></h4>
    <h4><?= "Уровень поиска: " . $model->levelSearch->name_level ?></h4>
    <h4><?= "Вид ресурса: " . $model->input->name_input ?></h4>
    <h5><?= "Суммарное количество : " . $model->sum_input ?></h5>
    <h4><?= "Вид результата: " . $model->output->name_output ?></h4>
    <h5><?= "Суммарное количество : " . $model->sum_output ?></h5>
    <h4><?= "Функция: " . $model->fun->name_fun ?></h4>

<?php
echo ChartJs::widget([
        'type' => ChartJs::TYPE_LINE,
        'data' => $dataToDraw,
        'options' => [
            'responsive' => true,
            'hoverMode' => 'index',
            'plugins' => [
                'datalabels' => [
                    'align' => new \yii\web\JsExpression("function(context) {
                    return context.datasetIndex === 0 ? '' : 'Организация';
                }"),
                    'borderRadius' => 4,
                    'color' => 'black',
                    'font' => [
                        'size' => 10,
                        'weight' => 600
                    ],
                    'offset' => 8,
                ]
            ],
            'tooltips' => [
                'mode' => 'nearest',
                'intersect' => true,
                'callbacks' => [
                    'title' => new \yii\web\JsExpression("function(tooltipItems, data) {
                    var xLabel = tooltipItems[0].xLabel;
                    var index = tooltipItems[0].index;
                    label = tooltipItems[0].datasetIndex === 0 ? 
                                        data['datasets'][0]['data'][index].label : 
                                        'Граница эффективности';
                    return label;
                }"),
                    'beforeLabel' => new \yii\web\JsExpression("function(tooltipItems, data) {
                    var xLabel = tooltipItems.xLabel;
                    label = 'Ресурс: ' + xLabel;
                    return label;
                }"),
                    'label' => new \yii\web\JsExpression("function(tooltipItems, data) {
                    var yLabel = tooltipItems.yLabel;
                    label = 'Результат: ' + yLabel;
                    return label;
                }")
                ]
            ],
            'hover' => [
                'mode' => 'nearest',
                'intersect' => true,
            ],
            'stacked' => false,
            'scales' => [
                'xAxes' => [[
                    'type' => 'linear',
                    'position' => 'bottom',
                    'ticks' => [
                        'min' => 0,
                        'max' => round($max_g),
                        'stepSize' => $max_g * 0.04
                    ]
                    //'precision' => 0.2,
                ]]
            ]
        ]]
);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'id_data_report',
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

        /*['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'],*/
    ],
]);
