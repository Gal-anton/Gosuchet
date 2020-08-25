<?php

namespace app\controllers;

use app\models\Master;
use app\models\search\OrganisationSearch;
use Yii;

class MasterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => new Master()]);
    }


    public function actionModel()
    {
        $request = Yii::$app->request;
        $modelNum = $request->get('model', 1);
        $model = new Master;
        $modelView = "model1";
        switch ($modelNum) {
            case "1" :
                $modelView = "model1";
                $searchModel = new OrganisationSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $params = array("model" => $model, "searchModel" => $searchModel, "orgData" => $dataProvider);
                break;
            case "2" :
                $modelView = "model2";
                $params = array("model" => $model);
                break;
        }
        $model->id_model = $modelNum;
        return $this->render($modelView, $params);
    }
}
