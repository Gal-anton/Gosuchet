<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\VidOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vid Organisations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-organisation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vid Organisation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_vid',
            'kod_vid',
            'name_vid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
