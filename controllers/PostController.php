<?php

namespace app\controllers;
use app\models\search\DataReportSearch;
use app\models\tables\DataReport;
use app\models\tables\Dmu;
use app\models\tables\Journal;
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
            $PreparedArray = ['InputArray' => [], 'Max' => 0, 'Min' => 0];
        }

        return $PreparedArray;
    }

    function CalculateRectangleCoordinate()
    {


    }

    function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    function SplitParallelepiped($Parallelepiped, $Step)
    {
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
        //print_r('FirstParall = ' . var_dump($FirstParallelepiped) . "Second = " . var_dump($SecondParallelepiped) . '\n');
        return $ArraySplittedParallelepipeds;
    }

    function getClosedValue($xArray, $array)
    {
        $resultArray = array();
        foreach ($xArray as $x) {
            foreach ($array as $index => $item) {
                if (($item["x"] - $x) > 0) {
                    $item_max = $item;
                    if (isset($array[$index - 1]) === true) {
                        $item_min = $array[$index - 1];
                        $resultArray[] = array('x' => $x,
                            'y' => round($item_max["y"] -
                                ($item_max["x"] - $item_min["x"]) /
                                (($item_max["x"] - $x) * ($item_max["y"] - $item_min["y"])))
                        );
                        break;
                    }
                    $resultArray[] = array('x' => $x, 'y' => round($item["y"]));
                } elseif (($item["x"] - $x) == 0) {
                    $resultArray[] = array('x' => $x, 'y' => round($item["y"]));
                    break;
                }
            }
        }
        return $resultArray;
    }

    function ScaleRanges($InputArray1, $InputArray2)
    {

        // TODO:
        // Как то нужно масштабировать для графиков
        // Может лучше вообще масштабировать на графиках? Так как в расчетах можно использовать значения текущие?
        // А если там будут миллионы?
    }

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $model = Dmu::findOne($request->get('id_dmu'));
        $organisations = $model->dataReports;
        if (empty($organisations) === true) {
            Yii::$app->session->setFlash('info', "Отсутствуют организации");
            return $this->redirect(['site/index']); // redirect to your next desired page
        }
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

        $Steps = 6; // Количество итераций
        $CurrentStep = 1;
        //$Xmin = 31;
        while ($CurrentStep <= $Steps) {
            $TempArrayOfParallelepipeds = [];
            foreach ($ArrayOfParallelepipeds as $tmpParallelepiped) {
                if ($tmpParallelepiped->step === $CurrentStep - 1) {
                    $TempArrayOfParallelepipeds = array_merge($TempArrayOfParallelepipeds, $this->SplitParallelepiped($tmpParallelepiped, $CurrentStep));
                }
            }
            $ArrayOfParallelepipeds = array_merge($ArrayOfParallelepipeds, $TempArrayOfParallelepipeds);
            $CurrentStep++;
        }

        //$Xmin = $num;
        $Arr = [['x' => $coord_left->x, 'y' => $coord_left->y]];
        foreach ($ArrayOfParallelepipeds as $tmpParallelepiped) {
            array_push($Arr, ['x' => $tmpParallelepiped->point2->x, 'y' => $tmpParallelepiped->point2->y]);
        }
        sort($Arr);
        $Arr = array_values($this->unique_multidim_array($Arr, "x"));

        $yExpectedValues = $this->getClosedValue($PreparedArrayX['InputArray'], $Arr);
        $this->setEfficency($model, $organisations, $yExpectedValues);
        // Делаем массивы для рисования точек
        $tek = NULL;
        $XData = implode(",", $PreparedArrayX['InputArray']);
        $YData = implode(",", $PreparedArrayY['InputArray']);
//        var_dump($PreparedArrayX['InputArray']);
//        var_dump($PreparedArrayY['InputArray']);
//        var_dump($XData);
//        var_dump($YData);


        //Делаем массивы для рисования линии эффективности
        $XLine = implode(', ', array_map(function ($value) {
            return round($value['x'], 3);
        }, $Arr));
        $YLine = implode(', ', array_map(function ($value) {
            return round($value['y'], 3);
        }, $Arr));

//        var_dump($XLine);
//        var_dump($YLine);

        //Делаем массив подписи данных

        $min = round($PreparedArrayX['Min']);
        $max = round($PreparedArrayX['Max']);

        if ($max == $min) $max++;
        $steps = sizeof($inputArr);
        $step_size = round($max / $steps, 3); //($max - $min) / $steps;

        $min_g = 0;
        $max_g = $max + $step_size * 0.5;

        //var_dump($inputArr);
//        var_dump($XData);
//        var_dump($YData);
//        var_dump($step_size);
        $Xlabels = '';
        $point = 0;
        for ($i = 0; $i <= $max_g; $i += $step_size) {
            $Xlabels .= $point . ',';
            $point += $step_size;
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
        $unitedData = array();
        foreach ($PreparedArrayX["InputArray"] as $index => $data) {
            $unitedData[] = array('label' => $labelArr[$index], 'x' => $data, 'y' => $PreparedArrayY["InputArray"][$index]);
        }

//        var_dump($Arr);
        //var_dump($unitedData);
        $yMin = min($PreparedArrayY['InputArray']);
        $yMax = max($PreparedArrayY['InputArray']);
        $xMin = min($PreparedArrayX['InputArray']);
        $xMax = max($PreparedArrayX['InputArray']);
        $this->setJournal($model, $xMax, $xMin, $yMax, $yMin);
        return $this->render('arr', compact('model', 'Xmin', 'Xmax', 'Jarr', 'XData',
            'YData', 'XLine', 'YLine', 'Xlabels',
            'min_g', 'max_g', 'title', 'labelNameFunction',
            'graphMin', 'graphMax', 'dataProvider', 'searchModel', "unitedData", 'Arr'));
    }

    /**
     * @param $dmu Dmu
     * @param $data DataReport[]
     * @param array $yExpectedValues
     */
    private function setEfficency($dmu, $data, $yExpectedValues)
    {
        $uniqYExpectedValues = $this->unique_multidim_array($yExpectedValues, 'x');
        $values = array('x' => [], 'y' => []);
        foreach ($uniqYExpectedValues as $yExpectedValue) {
            $values['x'][] = $yExpectedValue['x'];
            $values['y'][] = $yExpectedValue['y'];
        }
        //var_dump($values);
        $sumDifference = 0;
        foreach ($data as $item) {
            $index = array_search($item->input, $values['x']);
            //var_dump($index);
            $item->efficency = ($values['y'][$index] == 0) ? 0 :
                round($item->output / $values['y'][$index], 3);
            $item->save();
            $sumDifference += abs($item->output - $values['y'][$index]);
            //var_dump($item->getErrors());
        }
        $dmu->efficency = $sumDifference;
        $dmu->save();
    }

    /**
     * @param $model Dmu
     * @param $xMax integer|double
     * @param $xMin integer|double
     * @param $yMax integer|double
     * @param $yMin integer|double
     *
     * @return void
     */
    private function setJournal($model, $xMax, $xMin, $yMax, $yMin)
    {
        $journal = Journal::findOne(["id_dmu" => $model->id_dmu]);
        if (isset($journal) === false) {
            $journal = new Journal();
            $journal->id_dmu = $model->id_dmu;
            $journal->minX = $xMin;
            $journal->maxX = $xMax;
            $journal->minY = $yMin;
            $journal->maxY = $yMax;
            $journal->un_efficency = $model->efficency;
            $journal->save();
        }
    }

}
