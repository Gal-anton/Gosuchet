<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\tables\DataReport */
/* @var $id_org string */
/* @var $orgName string */

$this->title = 'Создание нового отчета';
$this->params['breadcrumbs'][] = ['label' => 'Отчетные данные', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id_org' => $id_org,
        'orgName' => $orgName,
    ]) ?>

</div>
