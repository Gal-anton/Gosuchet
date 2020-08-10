<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ppo */

$this->title = 'Create Ppo';
$this->params['breadcrumbs'][] = ['label' => 'Ppos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
