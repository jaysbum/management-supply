<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$init = array(0=>'เป็นกลุ่มหลัก');
$main_group = yii\helpers\ArrayHelper::map(app\models\CatalogGroup::find(['parent_id'=>0])->all(),'id','name');
$group = array_merge($init,$main_group);
?>

<div class="catalog-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
            'name' => 'parent_id',
            'data' => $group,
            'options' => [
                'placeholder' => 'เลือกกลุ่มพัสดุ ...',
                //'multiple' => true
            ],
        ])->label('กลุ่มพัสดุหลัก'); ?>
      <div class="row">
        <div class="col-md-6">
              <?= $form->field($model, 'start_niin')->textInput(['type' => 'number','class'=>'checkrange form-control']) ?>
        </div>
        <div class="col-md-6">
              <?= $form->field($model, 'end_niin')->textInput(['type' => 'number','class'=>'checkrange form-control']) ?>
        </div>
      </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
$('.checkrange').change(function(event) {
  var id = '#'+$(this).attr('id');
  $.get( "exist?niin=" + $(this).val(), function( data ) {
    if(data==1){
      alert('หมายเลข NIIN นี้อยู่ในช่วงที่กำหนดแล้ว กรุณาระบุใหม่');
      $(id).val('');
    }
  });
});
</script>
<?php $this->endBlock() ?>
