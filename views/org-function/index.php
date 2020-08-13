<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\OrgFunctionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Org Functions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Org Function', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_fun',
            'kod_fun',
            'name_fun',
            'id_tip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
