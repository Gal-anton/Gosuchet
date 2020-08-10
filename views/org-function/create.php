<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrgFunction */

$this->title = 'Create Org Function';
$this->params['breadcrumbs'][] = ['label' => 'Org Functions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-function-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
