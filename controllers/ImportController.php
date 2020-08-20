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
        return $this->render('index');


        /*
                error_reporting(E_ALL);
                set_time_limit(0);
                if (WebHelpers::request('new_task') === '1') //Генерируем новый ID задачи
                {
                    WebHelpers::echoJson(['task' => TaskHelper::generateTaskId()]);
                    return false;
                }

                //Запускаем длительный процесс (на 60 шагов по 200 миллисекунд) с контролем прогресса
                if (WebHelpers::request('long_process') === '1') {
                            $task_id = TaskHelper::getTaskId();
                            if ($task_id === null)
                                return false;

                            $manager = new ProgressManager($task_id);
                            $manager->setStepCount(self::STEP_COUNT);

                            $import = new Import();
                            $import->start(WebHelpers::request('number'), 5);
        print_r(WebHelpers::request('number'));
                            WebHelpers::echoJson([]);
                            return false;

                        }

                        if (WebHelpers::request('get_progress') === '1') //Получаем прогресс
                            {
                                $progress = ProgressManager::getProgress();
                                if ($progress !== null)
                                    WebHelpers::echoJson(['progress' => $progress]);
                                else
                                    WebHelpers::echoJson([]);

                                return false;
                            }

                return $this->render('index');*/
    }

}



