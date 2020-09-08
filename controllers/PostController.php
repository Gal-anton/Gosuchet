<?php

namespace app\controllers;
use app\models\search\DataReportSearch;
use app\models\tables\Dmu;
use Yii;
use yii\base\Exception;


class PostController extends AppController
{


    function PrepareRange($InputArray)
    {

        $PreparedArray = ['InputArray' => [], 'Max' => 0, 'Min' => 0];
        try {
            $min = min($InputArray);
            $max = max($InputArray);

            $PreparedArray['InputArray'] = $InputArray;
            $PreparedArray['Max'] = $max;
            $PreparedArray['Min'] = $min;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            $PreparedArray = ['InputArray' => [],'Max' => 0,'Min' => 0];
        }

        return $PreparedArray;
    }

    function CalculateRectangleCoordinate() {


    }

    function SplitParallelepiped($Parallelepiped, $Step) {
        $exp = pow(2, $Step);
        $ArraySplittedParallelepipeds = [];
        $FirstParallelepiped = new Parallelepiped(new Coordinate(), new Coordinate());
        $SecondParallelepiped = new Parallelepiped(new Coordinate(), new Coordinate());

        $FirstParallelepiped->step = $Step;
        $FirstParallelepiped->source = '1: [' . $Parallelepiped->point1->x . ',' . $Parallelepiped->point1->y . '] x [' . $Parallelepiped->point2->x . ',' . $Parallelepiped->point2->y . ']';
        $FirstParallelepiped->point1 = $Parallelepiped->point1;

        $FirstParallelepiped->point2->x = ($Parallelepiped->point1->x + $Parallelepiped->point2->x) / 2 -
            (($Parallelepiped->point1->x + $Parallelepiped->point2->x) / 2 - $Parallelepiped->point1->x) * 1 / $exp;
        $FirstParallelepiped->point2->y = ($Parallelepiped->point1->y + $Parallelepiped->point2->y) / 2 +
            (($Parallelepiped->point1->y + $Parallelepiped->point2->y) / 2 - $Parallelepiped->point1->y) * 1 / $exp;
//        $FirstParallelepiped->point2->z = 
//                ($Parallelepiped->point1->z + $Parallelepiped->point2->z)/2 -
//                (($Parallelepiped->point1->z + $Parallelepiped->point2->z)/2 - $Parallelepiped->point1->z) * 1/$exp;

        $SecondParallelepiped->step = $Step;
        $SecondParallelepiped->source = '2: [' . $Parallelepiped->point1->x . ',' . $Parallelepiped->point1->y . '] x [' . $Parallelepiped->point2->x . ',' . $Parallelepiped->point2->y . ']';
        $SecondParallelepiped->point2 = $Parallelepiped->point2;
        $SecondParallelepiped->point1 = $FirstParallelepiped->point2;

        array_push($ArraySplittedParallelepipeds, $FirstParallelepiped, $SecondParallelepiped);

        return $ArraySplittedParallelepipeds;
    }

    function ScaleRanges($InputArray1,$InputArray2) {

        // TODO:
        // Как то нужно масштабировать для графиков
        // Может лучше вообще масштабировать на графиках? Так как в расчетах можно использовать значения текущие?
        // А если там будут миллионы?
    }


    public function actionIndex1($name = 'Guest') {
        $hello = 'Hello!';
        $hi = 'Hi!';
        return $this->render('index', compact('hello','hi','name'));

    }

    public function actionTest() {

        return $this->render('test');

    }

    public function actionIndex()
    {


        $request = Yii::$app->request;
        $model = Dmu::findOne($request->get('id_dmu'));
        $organisations = $model->dataReports;

        $searchModel = new DataReportSearch();
        $dataProvider = $searchModel->search([$searchModel->formName() => ['id_dmu' => $model->id_dmu]]);


        $inputArr = array();
        $outputArr = array();
        $labelArr = array();
        foreach ($organisations as $index => $organisation) {
            $labelArr[$index] = $organisation->org->short_name;
            $inputArr[$index] = $organisation->input;
            $outputArr[$index] = $organisation->output;
        }
        $title = $model->dmu_dmu;

        $PreparedArrayY = $this->PrepareRange($outputArr);
        $PreparedArrayX = $this->PrepareRange($inputArr);

        $coord_left = new Coordinate($PreparedArrayX['Min'], $PreparedArrayY['Min']);
        $coord_right = new Coordinate($PreparedArrayX['Max'], $PreparedArrayY['Max']);

        $Parallelepiped = new Parallelepiped($coord_left, $coord_right, 0);

        $ArrayOfParallelepipeds = [$Parallelepiped];

        $Steps = 5; // Количество итераций
        $CurrentStep = 1;
        //$Xmin = 31;
        while ($CurrentStep <= $Steps) {
            $TempArrayOfParallelepipeds = [];
            foreach ($ArrayOfParallelepipeds as $tmpParallelepiped) {
                if ($tmpParallelepiped->step == $CurrentStep - 1){
                    $TempArrayOfParallelepipeds = array_merge($TempArrayOfParallelepipeds, $this->SplitParallelepiped($tmpParallelepiped,$CurrentStep));
                }
            }
            $ArrayOfParallelepipeds = array_merge($ArrayOfParallelepipeds, $TempArrayOfParallelepipeds);
            $CurrentStep ++;
        }

        //$Xmin = $num;
        $Arr = [['x' => $coord_left->x,'y' => $coord_left->y]];
        foreach ($ArrayOfParallelepipeds as $tmpParallelepiped) {
            array_push($Arr, ['x' => $tmpParallelepiped->point2->x,'y' => $tmpParallelepiped->point2->y]);
        }
        sort($Arr);


        // Делаем массивы для рисования точек
        $tek = NULL;
        $XData = '';
        foreach ($PreparedArrayX['InputArray'] as $X) {
            if ($X <> $tek){
                $XData .= $X.',';
                $tek = $X;
            }
        }
        $XData = substr($XData, 0, strlen($XData)-1);
        $tek = NULL;
        $YData = '';
        foreach ($PreparedArrayY['InputArray'] as $Y) {
            if ($Y <> $tek){
                $YData .= $Y . ',';
                $tek = $Y;
            }
        }
        $YData = substr($YData, 0, strlen($YData)-1);
        // 

        //Делаем массивы для рисования линии эффективности
        $tek = 0;
        $Xmax = '';
        $XLine = '';
        $YLine = '';
        foreach ($Arr as $Y) {
            if ($Y <> $tek) {
                $Xmax .= '[' . $Y['x'] . ',' . $Y['y'] . '],';
                $XLine .= $Y['x'] . ',';
                $YLine .= $Y['y'] . ',';
                $tek = $Y;
            }
        }
        // var_dump($Arr);
        $Xmax = substr($Xmax, 0, strlen($Xmax) - 1);
        $XLine = substr($XLine, 0, strlen($XLine) - 1);
        $YLine = substr($YLine, 0, strlen($YLine) - 1);
        //

        //Делаем массив подписи данных
        $min = round($PreparedArrayX['Min']);
        $max = round($PreparedArrayX['Max']);
        $steps = sizeof($inputArr);
        //$steps = 15;
        $step_size = ($max - $min) / $steps;

        $min_g = round($min - $step_size / 2);
        if ($min_g < 0) $min_g = 0;
        $max_g = round($max + $step_size / 2);
        $step_size = round(($max_g - $min_g) / $steps);
        $Xlabels = '0,';
        $point = '0';
        for ($i = 0; $i <= $max_g; $i += $step_size) {
            $point += $step_size;
            $Xlabels .= $point . ',';
        }
        $Xlabels = substr($Xlabels, 0, strlen($Xlabels) - 1);


        //делаем строку функции для подписи кнопок
        $labelNameFunction = '';
        for ($i = 0; $i < sizeof($inputArr); $i++) {
            $labelNameFunction .= "if (''+v2+v3 == '" .
                (string)$inputArr[$i] .
                (string)$outputArr[$i] . "') " .
                "{city = '" . (string)$labelArr[$i] . "';};";
        }

        //$Jarr = $ArrayOfParallelepipeds;
        $Jarr = $Arr;
        $graphMax = (float)$PreparedArrayY['Max'];
        $graphMin = (float)$PreparedArrayY['Min'];
        if ($graphMin < 0) {
            $graphMin = 0;
        }
        $sumInput = (float)array_sum($PreparedArrayX['InputArray']);
        $sumOutput = (float)array_sum($PreparedArrayY['InputArray']);
        return $this->render('arr', compact('model', 'Xmin', 'Xmax', 'Jarr', 'XData',
            'YData', 'XLine', 'YLine', 'Xlabels',
            'min_g', 'max_g', 'title', 'labelNameFunction',
            'graphMin', 'graphMax', 'sumInput', 'sumOutput', 'dataProvider', 'searchModel'));
    }

}
