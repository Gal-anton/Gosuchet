<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VidOrganisation */

$this->title = 'Create Vid Organisation';
$this->params['breadcrumbs'][] = ['label' => 'Vid Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vid-organisation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
