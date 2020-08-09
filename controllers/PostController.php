<?php

namespace app\controllers;
use Yii;


 
class PostController extends AppController {
        
  
    function PrepareRange($InputArray) {        
        
        $PreparedArray = ['InputArray' => [],'Max' => 0,'Min' => 0];
        try {
            $arr_count = sizeof($InputArray);
            $tmp_arr = $InputArray;                        
            sort($tmp_arr);
            
            $Xmin = $tmp_arr[0];
            $Xmax = $tmp_arr[$arr_count - 1];

            $PreparedArray['InputArray'] = $InputArray;
            $PreparedArray['Max'] = $Xmax;
            $PreparedArray['Min'] = $Xmin;
            
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
    
    public function actionIndex($Xarr = null,$Xmin = null,$Xmax = null,$direction = 1) {
        
        
        $request = Yii::$app->request;
        $job = $request->get('job',1);
        
        $mo_group = 1;
        if ($job == 1)
            {
            $title = 'Красноярский край (обеспеченность от 20 тыс. до 35 тыс.)';
            $Inp1_arr = [
                28109750,
                32965800,
                25411500,
                27166300,
                22956900,
                32413500,
                37673500,
                78985000,
                31457100,
                32803931
            ];
            $Inp2_arr = [
                13375,
                18277,
                20921,
                22973,
                23971,
                29117,
                29813,
                31545,
                45532,
                48640
            ];
            $Lab_arr = [
                "Дзержинский район",
                "Большемуртинский район",
                "Уярский район",
                "Березовский район",
                "Иланский район",
                "г. Дивногорск",
                "Нижнеингашский район",
                "Ужурский район",
                "Курагинский район",
                "Емельяновский район"
            ];
        } 
        elseif ($job == 2)
            {
            $title = 'Красноярский край (обеспеченность более 35 тыс. до 50 тыс.)';

            $Inp1_arr = [
                26007800,
                23449500,
                22829938,
                28134419,
                25954980,
                27911313,
                25123216,
                22650000,
                37274100,
                28505900,
                32029325,
                39300611,
                33613812,
                56484521
            ];
            $Inp2_arr = [
                8151,
                10038,
                11411,
                11632,
                15390,
                15780,
                20001,
                20266,
                22393,
                25542,
                25954,
                31259,
                32283,
                45544,
            ];
            $Lab_arr = [
                "Тюхтетский район",
                "Боготольский район",
                "Идринский район",
                "Тасеевский район",
                "Ачинский район",
                "Манский район",
                "Сухобузимский район",
                "Абанский район",
                "Назаровский район",
                "Канский район",
                "Минусинский район",
                "Рыбинский район",
                "Шушенский район",
                "Богучанский район"
            ];
        } 
        elseif ($job == 3) 
            {
            $title = 'Красноярский край (обеспеченность более 50 тыс. и менее 65 тыс.)';
            $Inp1_arr = [
                27758000,
                23922100,
                34159067,
                10261940,
                28839840,
                36262700,
                45365964
            ];
            $Inp2_arr = [
                9844,
                13102,
                14152,
                14598,
                15172,
                18837,
                21122
            ];
            $Lab_arr = [
                "Бирилюсский район",
                "Новоселовский район",
                "Краснотуранский район",
                "Мотыгинский район",
                "Каратузский район",
                "Балахтинский район",
                "Кежемский район"
            ];
        }
        elseif ($job == 4) 
            {
            $title = 'Красноярский край (Население до 20 тыс. чел.)';
            $Inp1_arr = [
                26007800,
                27758000,
                23449500,
                22829938,
                28134419,
                23922100,
                28109750,
                34159067,
                10261940,
                28839840,
                25954980,
                27911313,
                32965800,
                36262700
            ];
            $Inp2_arr = [
                48658,
                51435,
                48177,
                45856,
                42418,
                52236,
                34594,
                50540,
                60848,
                50104,
                45721,
                41878,
                29164,
                50479
            ];
            $Lab_arr = [
                "Тюхтетский район",
                "Бирилюсский район",
                "Боготольский район",
                "Идринский район",
                "Тасеевский район",
                "Новоселовский район",
                "Дзержинский район",
                "Краснотуранский район",
                "Мотыгинский район",
                "Каратузский район",
                "Ачинский район",
                "Манский район",
                "Большемуртинский район",
                "Балахтинский район"
            ];
        }
        elseif ($job == 5) 
            {
            $title = 'Красноярский край (Население от 20 тыс. чел. до 20 тыс. чел.)';
            $Inp1_arr = [
               25123216,
                22650000,
                25411500,
                45365964,
                37274100,
                27166300,
                22956900,
                28505900,
                32029325,
                32413500,
                37673500
            ];
            $Inp2_arr = [
               43001,
                40587,
                21051,
                64431,
                39800,
                23831,
                29819,
                36164,
                38262,
                32326,
                34546
            ];
            $Lab_arr = [
             "Сухобузимский район",
                "Абанский район",
                "Уярский район",
                "Кежемский район",
                "Назаровский район",
                "Березовский район",
                "Иланский район",
                "Канский район",
                "Минусинский район",
                "г. Дивногорск",
                "Нижнеингашский район"
            ];
        }
        elseif ($job == 6) 
            {
            $title = 'Красноярский край (Население более 30 тыс. чел.)';
            $Inp1_arr = [
                39300611,
                78985000,
                33613812,
                31457100,
                56484521,
                32803931
            ];
            $Inp2_arr = [
                40499,
                34364,
                41801,
                23239,
                44535,
                32474
            ];
            $Lab_arr = [
                "Рыбинский район",
                "Ужурский район",
                "Шушенский район",
                "Курагинский район",
                "Богучанский район",
                "Емельяновский район"
            ];
        }


        $PreparedArray1 = $this->PrepareRange($Inp1_arr);
        $PreparedArray2 = $this->PrepareRange($Inp2_arr);
        
//        if ($PreparedArray1['Max'] - $PreparedArray1['Min'] > $PreparedArray2['Max'] - $PreparedArray2['Min']) {
            $PreparedArrayX = $PreparedArray2;
            $PreparedArrayY = $PreparedArray1;
//        } else {
//            $PreparedArrayX = $PreparedArray1;
//            $PreparedArrayY = $PreparedArray2;
//        }

        $coord_left = new Coordinate($PreparedArrayX['Min'],$PreparedArrayY['Min']);
        $coord_right = new Coordinate($PreparedArrayX['Max'],$PreparedArrayY['Max']);
        
        $Parallelepiped = new Parallelepiped($coord_left,$coord_right,0);
        
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
                $YData .= $Y.',';
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
            if ($Y <> $tek){
                $Xmax .= '['.$Y['x'].','.$Y['y'].'],';
                $XLine .= $Y['x'].',';
                $YLine .= $Y['y'].',';
                $tek = $Y;
            }
            
        }
        $Xmax = substr($Xmax, 0, strlen($Xmax)-1);
        $XLine = substr($XLine, 0, strlen($XLine)-1);        
        $YLine = substr($YLine, 0, strlen($YLine)-1);        
        //
        
        //Делаем массив подписи данных
        $min = round($PreparedArrayX['Min']);
        $max = round($PreparedArrayX['Max']);                
        $steps = sizeof($Inp1_arr);
        $steps = 15;
        $step_size = ($max-$min)/$steps;
                
        $min_g  = round($min - $step_size/2);
        if ($min_g < 0) $min_g = 0;
        $max_g =  round($max + $step_size/2);        
        $step_size = round(($max_g-$min_g)/$steps);
        $Xlabels = '';
        $point = 0;
        for ($i = $min_g ; $i <= $max_g ; $i = $i + $step_size) {
            $point = $point + $step_size; 
            $Xlabels = $Xlabels.$point.',';
        }
        $Xlabels = substr($Xlabels, 0, strlen($Xlabels)-1);
        
        //делаем строку функции для подписи кнопок
        $func_txt = '';
        for($i = 0; $i < sizeof($Inp1_arr);$i++) {
            $func_txt.="if (''+v2+v3 == '".(string)$Inp2_arr[$i].(string)$Inp1_arr[$i]."') {city = '".(string)$Lab_arr[$i]."';};";
        }
        
        //$Jarr = $ArrayOfParallelepipeds;
        $Jarr = $Arr;
        $graphMax = $PreparedArrayY['Max'] + 10000;
        $graphMin = $PreparedArrayY['Min'] - 10000;
        if ($graphMin < 0) $graphMin = 0;
        return $this->render('arr', compact('Xmin','Xmax','Jarr','XData','YData','XLine','YLine','Xlabels','min_g','max_g','title','func_txt','graphMin','graphMax'));
    }
    
}
