<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\OktmoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oktmos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oktmo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Oktmo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_oktmo',
            'kod_oktmo',
            'name_oktmo',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
