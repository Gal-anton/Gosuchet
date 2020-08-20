<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\OutputsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды результата';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outputs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить вид результата', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_output',
            'kod_output',
            'name_output',
            //'id_fun',
            ['attribute' => 'name_fun', 'label' => 'Функция', 'value' => 'fun.name_fun'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
