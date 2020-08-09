<?php
namespace app\controllers;
 class Coordinate {     
     public $x = 0;
     public $y = 0;
    // public $z = 0;
     
     function __construct($x = 0, $y = 0/*, $z = 0*/) {
         $this->x = $x;
         $this->y = $y;
         //$this->z = $z;
         return $this;        
     }
 }