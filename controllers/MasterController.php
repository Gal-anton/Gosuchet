<?php

namespace app\controllers;

use app\models\Master;
use app\models\search\OrganisationSearch;
use app\models\search\OwnerSearch;
use app\models\tables\Dmu;
use app\models\tables\Oktmo;
use app\models\tables\Organisation;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

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
            $params = array("model" => $model,
                "organisations" => $listOrg,
                "searchModel" => new OrganisationSearch());

            return $this->render("listOrg", $params);
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
     * @return ActiveDataProvider
     */
    private function getSimilarOrgByOrg(Dmu $dmu)
    {
        $organisationCriteria = $dmu->criteriaIdOrg;
        $kod_oktmo = (isset($organisationCriteria->oktmo) === true) ? $organisationCriteria->oktmo->kod_oktmo : "";

        $query = new Query();
        $query->select('*')
            ->from(Organisation::tableName())
            ->andWhere(['id_tip' => $organisationCriteria->id_tip])
            ->andWhere(['id_vid' => $organisationCriteria->id_vid])
            ->andWhere(['id_okfs' => $organisationCriteria->id_okfs])
            ->innerJoin(Oktmo::tableName(),
                Organisation::tableName() . '.id_oktmo = ' . Oktmo::tableName() . '.id_oktmo')
            ->andWhere(['like', Oktmo::tableName() . '.kod_oktmo',
                $this->getOktmoSearch($dmu->level_search, $kod_oktmo) . "%", false])
            ->all();

        $arrayOrg = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $arrayOrg;
    }

    /**
     * @param Dmu $dmu
     * @return ActiveDataProvider
     */
    private function getSimilarOrgByOwner(Dmu $dmu)
    {
        $owner = $dmu->criteriaIdOrg;
        $organisationCriteria = $owner->organisations[0];
        $kod_oktmo = (isset($organisationCriteria->oktmo) === true) ? $organisationCriteria->oktmo->kod_oktmo : "";
        $ownerCriteria = $dmu->criteria_id_org;

        $query = new Query();
        $query->select('*')
            ->from(Organisation::tableName())
            ->andWhere(['id_owner' => $ownerCriteria])
            ->andWhere(['id_vid' => $dmu->vid_org])
            ->innerJoin(Oktmo::tableName(),
                Organisation::tableName() . '.id_oktmo = ' . Oktmo::tableName() . '.id_oktmo')
            ->andWhere(['like', Oktmo::tableName() . '.kod_oktmo',
                $this->getOktmoSearch($dmu->level_search, $kod_oktmo) . "%", false])
            ->all();

        $arrayOrg = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $arrayOrg;
    }

    private function getOktmoSearch($level_search, $kod_oktmo = "")
    {
        $search = "";
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
