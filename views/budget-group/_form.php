<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BudgetGroup;
use yii\helpers\ArrayHelper;

$parentList = ArrayHelper::map(BudgetGroup::find()->where('parent > 0')->all(), 'id', 'name');
?>

<div class="budget-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('ชื่อกลุ่มงบประมาณ') ?>

      <div class="row">
        <div class="col-md-9">
          <?= $form->field($model, 'desc')->textInput(['maxlength' => true])->label('คำอธิบาย(ถ้ามี)') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'year')->dropdownList(range(0, 99), ['options' => [60 => ['selected' => true]]])->label('ปีงบประมาณ') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'parent')->dropdownList([1 => 'ใช่', 0 => 'ไม่ใช่'], ['prompt' => 'เลือกเงื่อนไข'])->label('เป็นกลุ่มงบประมาณหลักหรือไม่') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'parent_id')->dropdownList($parentList, ['prompt' => 'เลือกชื่อกลุ่มงบประมาณหลัก', 'disabled' => true])->label('ชื่อกลุ่มงบประมาณหลัก') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'manage')->dropdownList([1 => 'ได้', 0 => 'ไม่ได้'], ['prompt' => 'เลือกเงื่อนไข'])->label('สามารถบริหารวงเงินได้หรือไม่') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'total')->textInput(['type' => 'number'])->label('วงเงินที่ได้รับ') ?>
        </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
  var remain = 999999999999999;
  var sum = 0;
  $(document).ready(function() {
    $.get( "budget-limit?id=" + $('#budgetgroup-parent_id').val(), function( data ) {
      remain = (data != '')?data:remain;
      remain = parseFloat(remain) + parseFloat($('#budgetgroup-total').val());
    });
    $.get( "budget-total?id=<?= (isset($_GET['id']))?$_GET['id']:0; ?>", function( data ) {
      sum = parseFloat(data);
    });
  $('#budgetgroup-parent').change(function(event) {
    if($(this).val() > 0){
      $('#budgetgroup-parent_id').prop('disabled', true);
    }else{
      $('#budgetgroup-parent_id').prop('disabled', false);
    }
  });
  $('#budgetgroup-parent_id').change(function(event) {
    if($(this).val() > 0){
      $('#budgetgroup-parent').val(0);
      $.get( "budget-limit?id=" + $(this).val(), function( data ) {
        remain = data;
      });
    }else{
      $('#budgetgroup-parent').val(1);
    }
  });
  $('#w0').submit(function(event) {
    var bool = false;
    if(parseFloat($('#budgetgroup-total').val()) > parseFloat(remain) && $('#budgetgroup-parent').val() == 0){
      alert("วงเงินรวมเกินกว่าที่กลุ่มงบประมาณหลักกำหนด ( วงเงินคงเหลือ : " + remain + " บาท )");
      bool = false;
    }else if($('#budgetgroup-parent').val() == 1 && $('#budgetgroup-total').val() < sum){
      alert("วงเงินรวมเกินกว่ายอดที่ท่านปรับลด ( วงเงินรวม : " + sum + " บาท )");
      bool = false;
    }else{
      bool = true;
    }
    return bool;
  });
});
</script>
<?php $this->endBlock() ?>
