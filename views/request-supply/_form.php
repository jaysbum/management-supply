<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\RequestSupply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-supply-form">

    <?php $form = ActiveForm::begin(); ?>

      <div class="row">
        <div class="col-md-4">
          <?= $form->field($model, 'doc_num')->textInput(['type'=>'number']) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'year')->dropdownList(range(0,99),['options'=>[60=>['selected'=>true]]]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'doc_date')->widget(DatePicker::classname(), [
                  'options' => ['placeholder' => 'เลือกวันที่เอกสาร ...'],
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd'
                  ]
              ])
          ?>
        </div>
      </div>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 4]) ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
