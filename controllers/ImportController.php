<?php

namespace app\controllers;

use app\models\import\Import;
use yii\web\Controller;

class ImportController extends Controller
{

    const STEP_COUNT = 10;
    const STEP_DELAY = 200000;

    public function actionIndex()
    {

        set_time_limit(0);
        ignore_user_abort(true);
        $import = new Import();
        $import->start();
        set_time_limit(120);
        ignore_user_abort(false);
        return $this->render('index');

    }

}



