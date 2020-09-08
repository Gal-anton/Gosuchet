<?php

namespace app\controllers;

use app\models\search\DmuSearch;
use app\models\tables\DataReport;
use app\models\tables\Dmu;
use app\models\tables\Oktmo;
use app\models\tables\Organisation;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DmuController implements the CRUD actions for Dmu model.
 */
class DmuController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dmu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DmuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dmu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dmu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dmu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_dmu]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dmu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_dmu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dmu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dmu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dmu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dmu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionData($id)
    {
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
        }
        $listOrg = $this->getSimilarOrg($model);

        if (empty($listOrg->models) === true) {
            Yii::$app->session->setFlash('info', "Отсутствуют однотипные организации");
            return $this->redirect(['index']); // redirect to your next desired page
        }

        $items = array();
        foreach ($listOrg->models as $org) {
            $item = new DataReport();
            $item->id_org = $org['id_org'];
            $item->id_dmu = $model->id_dmu;
            $items[] = $item;
        }

        if (Model::loadMultiple($items, Yii::$app->request->post()) &&
            Model::validateMultiple($items)) {
            $count = 0;
            foreach ($items as $item) {
                // populate and save records for each model
                if ($item->save()) {
                    // do something here after saving
                    $count++;
                }
            }
            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['index']); // redirect to your next desired page
        } else {
            return $this->render('data', [
                'items' => $items,
            ]);
        }

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
                //'pageSize' => 20,
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
                //'pageSize' => 20,
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
