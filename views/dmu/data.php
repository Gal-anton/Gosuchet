<?php

use app\models\tables\Organisation;
use app\models\tables\Orgstruct;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $items \app\models\tables\DataReport[] */

$this->title = 'Изменить Данные организаций';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';

?>
<div class="form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table table-striped">
        <?php foreach ($items as $i => $item): ?>
            <tr>
                <td><?= Organisation::findOne($item->id_org)->short_name . '</td>'; ?>
                <td><?= $form->field($item, "[$i]id_orgstr")->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Orgstruct::find()
                            ->select(['id_orgstr', 'concat(kod_orgstr, " ", name_orgstr) as value'])
                            ->orderBy(['value' => SORT_ASC])->asArray()->all(), 'id_orgstr', 'value'),
                        'options' => ['placeholder' => 'Выберите структуру организации ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]); ?></td>
                <td><?= $form->field($item, "[$i]input"); ?></td>
                <td><?= $form->field($item, "[$i]output"); ?></td>
            </tr>
            <?= $form->field($item, "[$i]id_dmu")->hiddenInput()->label(false); ?>
            <?= $form->field($item, "[$i]id_org")->hiddenInput()->label(false); ?>
        <?php endforeach; ?>
    </table>
    <?= Html::submitButton('Сохранить и построить график', ['class' => 'btn btn-success']); ?>
    <?php ActiveForm::end(); ?>
</div><!-- form -->
