<?php
namespace app\controllers;
class Parallelepiped {

     public $point1;
     public $point2;    // Координаты диагонали
     public $step = 0;  // На каком шаге получен
     public $source;    // Исходный прямоугольник

     function __construct($point1,$point2,$step = 0) {

         $this->point1 = $point1;
         $this->point2 = $point2;
         $this->step = $step;
     }
 }
