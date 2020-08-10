<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VidOrganisationSearch */
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
