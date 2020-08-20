<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\TipOrganisation */

$this->title = 'Добавить тип';
$this->params['breadcrumbs'][] = ['label' => 'Тип организациц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tip-organisation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
