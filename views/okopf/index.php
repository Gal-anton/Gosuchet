<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\OkopfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Okopfs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okopf-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Okopf', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_okopf',
            'kod_okopf',
            'name_okopf',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
