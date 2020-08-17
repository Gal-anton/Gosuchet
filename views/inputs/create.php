<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\Inputs */

$this->title = 'Создать вид ресурса';
$this->params['breadcrumbs'][] = ['label' => 'Вид ресурса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inputs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
