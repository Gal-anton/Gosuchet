<?php

namespace app\controllers;

use app\models\Import;

class ImportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        set_time_limit(100000);
        ignore_user_abort(true);
        $import = new Import();
        $import->start();
        set_time_limit(120);
        return $this->render('index');
    }

}
