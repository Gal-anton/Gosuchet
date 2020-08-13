<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InputsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inputs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inputs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inputs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_input',
            'kod_input',
            'name_input',
            'id_fun',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
