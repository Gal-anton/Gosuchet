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

use yii\grid\GridView;

$this->title = $model->dmu_dmu;
?>


    <SCRIPT>
        <?php
        /* $this->registerJsFile('js/ChartNew.js-master/Add-ins/format.js');
         $this->registerJsFile('js/ChartNew.js-master/ChartNew.js');
         $this->registerJsFile('js/ChartNew.js-master/Add-ins/stats.js');*/
        ?>
        function label_by_data(v2, v3) {
            let money_per_man = Math.round(v3 / v2);
            let city = ``;
            <?php echo $labelNameFunction?>
            //return(city + ' (' + money_per_man + ' руб/чел)');
            return (city);
        }

        var charJSPersonalDefaultOptions = {
            decimalSeparator: ",",
            thousandSeparator: ".",
            roundNumber: "none",
            graphTitleFontSize: 2
        };

        //defCanvasWidth=3000;
        //  defCanvasHeight=2000;
        defCanvasWidth = 1200;
        defCanvasHeight = 500;

        var mydata1 = {
            labels: [<?php echo $Xlabels?>],
            xBegin: <?=$min_g?>,
            xEnd: <?=$max_g?>,

            datasets: [
                {
                    pointColor: "black",
                    strokeColor: "rgba(0,0,0,0)",
                    pointStrokeColor: "black",
                    data: [<?=$YData?>],
                    xPos: [<?=$XData?>],
                    title: "Организация"
                },
                {
                    pointColor: "rgba(0,0,0,0)",
                    strokeColor: "red",
                    pointStrokeColor: "rgba(0,0,0,0)",
                    //data : ["<%=#linear_regression_b0#+new Date(2015,5,1,0,0,0).getTime()*#linear_regression_b1#%>",,,"<%=#linear_regression_b0#+new Date(2015,6,1,0,0,0).getTime()*#linear_regression_b1#%>"],
                    data: [<?=$YLine?>],
                    //data : [11582678.804398,22463377.075195,32683387.784958,42284003.90625,51292754.087448,59755519.40918,67704416.627884,75171562.5,82121169.782639,88649588.745117,94781595.170975,100541964.84375,105947214.95247,111024874.14551,115794212.47673,120274500,124135392.9348,127762292.3584,131168962.59499,134369167.96875,137372084.69582,140193006.46973,142842638.87596,145331687.5,147648223.26088,149824362.91504,151868365.05699,153788488.28125,155590238.31749,157282791.38184,158872570.82558,160366000],
                    xPos: [<?=$XLine?>],
                    //data : [31,31,31,31,26.25390625,22.5625,22.5625,19.71484375,17.5,17.5,17.5,15.91796875,14.6875,14.6875,13.73828125],

                    title: "Граница эффективности"
                }
            ]
        };


        var opt1 = {
            canvasBorders: true,
            canvasBordersWidth: 3,
            canvasBordersColor: "black",
            datasetFill: false,
            graphTitle: <?='"' . $title . '"'?>,
            animations: false,
            graphTitleFontSize: 18,
            graphMin: <?=$graphMin?>,
            graphMax: <?=$graphMax?>,
            yAxisMinimumInterval: 5,
            thousandSeparator: "",
            decimalSeparator: ".",
            bezierCurve: false,
            annotateDisplay: true,
            inGraphDataShow: true,
            inGraphDataTmpl: "<%=(v1 == 'Граница эффективности' ? '' : label_by_data(v2,v3))%>",
        };

        stats(mydata1, opt1);
    </SCRIPT>

    <h3><?php echo $this->title ?></h3>

    <h4><?= "Модель: " . $model->mod->name_mod ?></h4>
    <h4><?= "Уровень поиска: " . $model->levelSearch->name_level ?></h4>
    <h4><?= "Вид ресурса: " . $model->input->name_input ?></h4>
    <h5><?= "Суммарное количество : " . $model->sum_input ?></h5>
    <h4><?= "Вид результата: " . $model->output->name_output ?></h4>
    <h5><?= "Суммарное количество : " . $model->sum_output ?></h5>
    <h4><?= "Функция: " . $model->fun->name_fun ?></h4>

    <script>

        document.write("<canvas id=\"canvas_Line1\" height=\"" + defCanvasHeight + "\" width=\"" + defCanvasWidth + "\"></canvas>");
        window.onload = function () {
            var myLine = new Chart(document.getElementById("canvas_Line1").getContext("2d")).Line(mydata1, opt1);
        }
    </script>

<?php
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

        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'],
    ],
]);

