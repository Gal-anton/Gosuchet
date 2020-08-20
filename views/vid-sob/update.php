<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidSob */

$this->title = 'Обновить код ОКФС: ' . $model->kod_okfs;
$this->params['breadcrumbs'][] = ['label' => 'Вид собственности (ОКФС)', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kod_okfs, 'url' => ['view', 'id' => $model->id_okfs]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vid-sob-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
