<?php

namespace app\controllers;

use app\models\Master;
use Yii;

class MasterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => new Master()]);
    }


    public function actionTest()
    {
        // Создаём экземпляр модели.
        $model = new Master();
        // Устанавливаем формат ответа JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // Если пришёл AJAX запрос
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            // Получаем данные модели из запроса
            if ($model->load($data)) {
                //Если всё успешно, отправляем ответ с данными
                return [
                    "data" => $model->id_model,
                    "error" => null
                ];
            } else {
                // Если нет, отправляем ответ с сообщением об ошибке
                return [
                    "data" => null,
                    "error" => "error1"
                ];
            }
        } else {
            // Если это не AJAX запрос, отправляем ответ с сообщением об ошибке
            return [
                "data" => null,
                "error" => "error2"
            ];
        }
    }
}
