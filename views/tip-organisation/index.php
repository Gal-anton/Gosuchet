<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tip Organisations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tip-organisation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tip Organisation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tip',
            'kod_tip',
            'name_tip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
