<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Okopf */

$this->title = 'Create Okopf';
$this->params['breadcrumbs'][] = ['label' => 'Okopfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="okopf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
