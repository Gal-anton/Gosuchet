<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidOrganisation */

$this->title = 'Добавить вид организации';
$this->params['breadcrumbs'][] = ['label' => 'Вид организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-organisation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
