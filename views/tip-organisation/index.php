<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TipOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тип организации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tip-organisation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тип', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_tip',
            'kod_tip',
            'name_tip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
