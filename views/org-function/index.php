<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrgFunctionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Функции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать функцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_fun',
            'kod_fun',
            'name_fun',
            ['label' => 'Тип организации',
                'format' => 'raw',
                'value' => function ($data) {
                    $dataOut = "";
                    $dataOut .= ($data->autonomus == true) ? "Автономное учреждение<br>" : "";
                    $dataOut .= ($data->budgetary == true) ? "Бюджетное учреждение<br>" : "";
                    $dataOut .= ($data->kazennoe == true) ? "Казенное учреждение<br>" : "";
                    return $dataOut;
                }],
            //'autonomus',
            //'budgetary',
            //'kazennoe',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
