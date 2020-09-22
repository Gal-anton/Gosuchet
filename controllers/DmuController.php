<?php

namespace app\controllers;

use app\models\search\DmuSearch;
use app\models\tables\DataReport;
use app\models\tables\Dmu;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

        $items = $model->dataReports;

        $count = $model->saveDataReports($items);
        if ($count !== false) {
            Yii::$app->session->setFlash('success', "Успешно обновлено {$count} записей.");
            return $this->redirect(['post/index?id_dmu=' . $model->id_dmu]); // redirect to your next desired page
        }

        return $this->render('update', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Deletes an existing Dmu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (StaleObjectException $e) {
        } catch (NotFoundHttpException $e) {
        } catch (Throwable $e) {
        }

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

    /**
     * @param $id
     * @return string|Response
     */
    public function actionData($id)
    {
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
            Yii::$app->session->setFlash('error', "Ошибка при загрузке данных");
            return $this->render("index");
        }

        $listOrg = $model->dataReports;
        if (empty($listOrg) !== true) {
            Yii::$app->session->setFlash('info', "Данные уже были введены, 
                                            перейдите на страницу справочники для дальнейшего изменения");
            return $this->redirect(['index']); // redirect to your next desired page
        }

        $listOrg = $model->getSimilarOrg();

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
        $count = $model->saveDataReports($items);
        if ($count !== false) {
            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['post/index?id_dmu=' . $model->id_dmu]); // redirect to your next desired page
        } else {
            return $this->render('data', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }
}
