<?php

namespace app\controllers;

use app\models\Master;
use app\models\search\OrganisationSearch;
use app\models\tables\Dmu;
use Yii;

class MasterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['model' => new Master()]);
    }


    public function actionModel()
    {
        $model = new Dmu();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return "OKAY";
        }
        $request = Yii::$app->request;
        $modelNum = $request->get('model', 1);
        $organisation = $request->getQueryParam('id_org');
        $modelView = "model1";
        switch ($modelNum) {
            case "1" :
                $modelView = "model1";
                $searchModel = new OrganisationSearch();
                if (isset($organisation) === true) {
                    $orgDataProvider = $searchModel->search([$searchModel->formName() => ["id_org" => $organisation]]);
                    $model->criteria_id_org = $organisation;
                } else {
                    $orgDataProvider = $searchModel->search(Yii::$app->request->queryParams);
                }
                $params = array("model" => $model, "searchModel" => $searchModel,
                    "orgData" => $orgDataProvider, "errors" => $model->getErrors());
                break;
            case "2" :
                $modelView = "model2";
                $params = array("model" => $model);
                break;
        }
        $model->id_mod = $modelNum;
        return $this->render($modelView, $params);
    }

    public function actionOrganisations()
    {
        return var_dump(Yii::$app->request);
    }
}
