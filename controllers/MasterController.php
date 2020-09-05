<?php

namespace app\controllers;

use app\models\Master;
use app\models\search\OrganisationSearch;
use app\models\search\OwnerSearch;
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
            $this->redirect("/dmu/data?id=" . $model->getPrimaryKey());
        }
        $request = Yii::$app->request;
        $modelNum = $request->get('model', 1);
        $organisation = $request->getQueryParam('id_org');
        $owner = $request->getQueryParam('id_owner');
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
                $searchModel = new OwnerSearch();
                if (isset($owner) === true) {
                    $orgDataProvider = $searchModel->search([$searchModel->formName() => ["id_owner" => $owner]]);
                    $model->criteria_id_org = $owner;
                } else {
                    $orgDataProvider = $searchModel->search(Yii::$app->request->queryParams);
                }
                $params = array("model" => $model, "searchModel" => $searchModel,
                    "orgData" => $orgDataProvider, "errors" => $model->getErrors());
                break;
        }
        $model->id_mod = $modelNum;
        return $this->render($modelView, $params);
    }

}
