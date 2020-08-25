<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\DmuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Перечень DMU';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dmu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_dmu',
            'dmu_dmu',
            //'kod_is',
            ['attribute' => 'name_fun', 'label' => 'Функция', 'value' => 'fun.name_fun'],
            ['attribute' => 'name_mod', 'label' => 'Модель', 'value' => 'mod.name_mod'],
            //'id_input',
            //'sum_input',
            //'id_output',
            //'sum_output',
            'efficency',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'],
        ],
    ]); ?>
</div>
