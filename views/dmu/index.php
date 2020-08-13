<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\DmuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dmus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dmu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_dmu',
            'dmu_dmu',
            'kod_is',
            'id_fun',
            'id_mod',
            //'id_input',
            //'sum_input',
            //'id_output',
            //'sum_output',
            //'efficency',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
