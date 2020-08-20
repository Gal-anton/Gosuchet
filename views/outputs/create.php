<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Outputs */

$this->title = 'Добавить вид результата';
$this->params['breadcrumbs'][] = ['label' => 'Вид результата', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outputs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
