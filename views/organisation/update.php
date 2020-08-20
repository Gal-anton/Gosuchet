<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Organisation */

$this->title = "Карточка организации: {$model->short_name}";
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_org, 'url' => ['view', 'id' => $model->id_org]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="organisation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
