<?php

namespace app\controllers;

use app\models\Master;
use app\models\search\OrganisationSearch;
use app\models\tables\Dmu;
use app\models\tables\Oktmo;
use app\models\tables\Organisation;
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
            $listOrg = $this->getSimilarOrg($model);
            $params = array("model" => $model, "organisations" => $listOrg);
            return var_dump($listOrg);
            //return $this->render("listOrg", $params);
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

    /**
     * @param $dmu Dmu
     * @return array|false
     */
    private function getSimilarOrg(Dmu $dmu)
    {
        $organisations = false;
        if ($dmu->id_mod == 1) {
            $organisations = $this->getSimilarOrgByOrg($dmu);
        } else if ($dmu->id_mod == 2) {
            $organisations = $this->getSimilarOrgByOwner($dmu);
        }
        return $organisations;
    }

    /**
     * @param Dmu $dmu
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getSimilarOrgByOrg(Dmu $dmu)
    {
        $kod_oktmo = (isset($organisationCriteria->oktmo) === true) ? $organisationCriteria->oktmo->kod_oktmo : "";
        $organisationCriteria = $dmu->criteriaIdOrg;
        $arrayOrg = Organisation::find()->where(['id_tip' => $organisationCriteria->id_tip,
            'id_vid' => $organisationCriteria->id_vid,
            'id_okfs' => $organisationCriteria->id_okfs,])
            ->joinWith(Oktmo::tableName())
            ->andWhere(['like', Oktmo::tableName() . '.kod_oktmo',
                $this->getOktmoSearch($dmu->level_search, $kod_oktmo . "%")])
            ->all();

        return $arrayOrg;
    }

    /**
     * @param Dmu $dmu
     * @return array
     */
    private function getSimilarOrgByOwner(Dmu $dmu)
    {
        return array();
    }

    private function getOktmoSearch($level_search, $kod_oktmo = "")
    {
        switch ($level_search) {
            case "1":
                $search = substr($kod_oktmo, 0, 2);
                break;
            case "2":
                $search = substr($kod_oktmo, 0, 5);
                break;
            case "3":
                $search = substr($kod_oktmo, 0, 8);
                break;
            default;
        }
        return $search;
    }
}
