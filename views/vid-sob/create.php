<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\VidSob */

$this->title = 'Добавить код ОКФС';
$this->params['breadcrumbs'][] = ['label' => 'Вид собственности (ОКФС)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-sob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
