<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\RequestSupply;
use yii\helpers\ArrayHelper;
$request = RequestSupply::find()->all();
$req_supply = array();
foreach ($request as $value) {
  if($value['remain'] > 0){
    $req_supply[$value['id']] = $value['doc_num']."/".$value['year']." จำนวน : ".$value['count']." รายการ  วงเงินจัดหา : ".number_format($value['total'])." เบิกจ่ายไปแล้ว : ".number_format($value['payment'])." คงเหลือ : ".number_format($value['remain']);
  }
}
$month = array(1 => 'ต.ค.', 2 => 'พ.ย.', 3 => 'ธ.ค.', 4 => 'ม.ค.', 5 => 'ก.พ.', 6 => 'มี.ค.', 7 => 'เม.ย.', 8 => 'พ.ค.', 9 => 'มิ.ย.', 10 => 'ก.ค.', 11 => 'ส.ค.', 12 => 'ก.ย.');
?>

<div class="budget-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_id')->widget(Select2::classname(), [
            'data' => $req_supply,
            'value' => 'id',
            'options' => ['placeholder' => 'เลือกรายการ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('เลขที่ใบแจ้ง')
    ?>
      <div class="row">
        <div class="col-md-3">
          <?= $form->field($model, 'month')->dropdownList($month,['prompt'=>'เลือกเดือน ...']) ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'year')->dropdownList(range(0,99),['options'=>[60=>['selected'=>true]]]) ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'total')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'payment_date')->widget(kartik\widgets\DatePicker::classname(), [
                  'options' => ['placeholder' => 'เลือกวันที่เบิกจ่าย ...'],
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd'
                  ]
              ])
          ?>
        </div>
      </div>

    <?= $form->field($model, 'remark')->textarea(['rows' => 3]) ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
var total = 0;
$('#budgetpayment-request_id').change(function(event) {
  $.getJSON( "get-budget-data?id=" + $(this).val(), function( data ) {
    total = data;
    $('#budgetpayment-total').val(data);
  });
});
$('#budgetpayment-total').on('keyup change',function(){
    if($(this).val() > total){
      //alert("over");
      $(this).val(total);
    }
});
</script>
<?php $this->endBlock() ?>
