<?php

use app\models\tables\Dmu;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model Dmu */
/* @var $organisations yii\data\ActiveDataProvider */
/* @var $searchModel app\models\search\OrganisationSearch */

?>
    <div class="master_data">
<?php
echo GridView::widget([
    'dataProvider' => $organisations,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'reg_num',
        'inn',
        //'full_name:ntext',
        'short_name',
        ['attribute' => 'tip_name', 'label' => 'Тип', 'value' => 'tip.name_tip'],
        'ppo',
        //'id_tip',
        //'id_vid',
        ['attribute' => 'vid_name', 'label' => 'Вид', 'value' => 'idV.name_vid'],
        ['attribute' => 'kod_okved', 'label' => 'ОКВЭД', 'value' => 'okved.kod_okved'],
        ['attribute' => 'kod_okato', 'label' => 'ОКАТО', 'value' => 'okato.kod_okato'],
        ['attribute' => 'kod_oktmo', 'label' => 'ОКТМО', 'value' => 'oktmo.kod_oktmo'],
        ['attribute' => 'kod_okfs', 'label' => 'ОКФС', 'value' => 'okfs.kod_okfs'],
        ['attribute' => 'kod_okopf', 'label' => 'ОКОПФ', 'value' => 'okopf.kod_okopf'],
        ['attribute' => 'owner_name', 'label' => 'Учредитель', 'value' => 'owner.reg_num'],
        //'id_okved',
        //'id_okato',
        //'id_oktmo',
        //'id_okfs',
        //'id_buj',
        //'id_okopf',
//        'id_owner',


    ],
]);
