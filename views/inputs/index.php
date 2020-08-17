<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\InputsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вид ресурса';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inputs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать вид ресурса', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_input',
            'kod_input',
            'name_input',
            //'id_fun',
            ['attribute' => 'name_fun', 'label' => 'Функция', 'value' => 'fun.name_fun'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
