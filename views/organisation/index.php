<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Справочник организаций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Внести новую организацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'reg_num',
            'inn',
            'full_name:ntext',
            'short_name',
            //['attribute' => 'tip_name','label' => 'Тип', 'value'=>'tip.name_tip'],
            'ppo',
            //'id_tip',
            //'id_vid',
            //'id_okved',
            //'id_okato',
            //'id_oktmo',
            //'id_okfs',
            //'id_buj',
            //'id_okopf',
            //'id_owner',
            //'created_at',
//            'updated_at',
//            ['label' => 'Отчеты',
//                'format' => 'raw',
//                'value' => function ($data) {
//                    return Html::a('Дабавить отчет', Url::to(['data-report/create?id_org=' . $data->id_org]));
//                }],
            ['class' => 'yii\grid\ActionColumn'],


        ],
    ]); ?>
</div>
