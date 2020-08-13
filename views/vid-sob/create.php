<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidSob */

$this->title = 'Create Vid Sob';
$this->params['breadcrumbs'][] = ['label' => 'Vid Sobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-sob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
