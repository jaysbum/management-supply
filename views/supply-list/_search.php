<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplyListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'nsn') ?>

    <?= $form->field($model, 'unit_issue') ?>

    <?php // echo $form->field($model, 'gpsc') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'real_price') ?>

    <?php // echo $form->field($model, 'real_quantity') ?>

    <?php // echo $form->field($model, 'real_total') ?>

    <?php // echo $form->field($model, 'margin_total') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
