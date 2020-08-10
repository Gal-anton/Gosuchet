<?php

namespace app\controllers;

use app\models\Import;

class ImportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $import = new Import();
        $import->start();

        return $this->render('index');
    }

}
