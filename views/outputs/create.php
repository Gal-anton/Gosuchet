<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outputs */

$this->title = 'Create Outputs';
$this->params['breadcrumbs'][] = ['label' => 'Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outputs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
