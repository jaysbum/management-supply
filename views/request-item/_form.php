<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\SupplyList;
use yii\helpers\ArrayHelper;
use app\models\RequestItem;

$supply_list = array();
$supply_use = SupplyList::find()->where('nsn is not null')->all();
foreach ($supply_use as $value) {
  $use = RequestItem::find()->where(['supply_id' => $value['id']])->sum('quantity');
  if($value['quantity'] > $use){
    $use = ($use>0)?$use:0;
    $supply_list[$value['id']] = $value['nsn']." : ".$value['name']." [ จำนวนที่ต้องการ : ".$value['quantity']." ออกแจ้งแล้ว : ".$use." คงเหลือ : ".($value['quantity'] - $use)." ] ";
  }
}
?>

<div class="request-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supply_id')->widget(Select2::classname(), [
            'data' => $supply_list,
            'value' => 'id',
            'options' => ['placeholder' => 'เลือกรายการ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('หมายเลขพัสดุที่แจ้ง')
    ?>

    <?= $form->field($model, 'request_id')->hiddenInput(['value'=>$_GET['rid']])->label(false) ?>

    <?= $form->field($model, 'budget_id')->hiddenInput(['value'=>0])->label(false) ?>

    <?= $form->field($model, 'price')->textInput(['type'=>'number','step'=>'any']) ?>

    <?= $form->field($model, 'quantity')->textInput(['type'=>'number']) ?>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
var remain;
$('#requestitem-supply_id').change(function(event) {
  $.getJSON( "get-budget-data?id=" + $(this).val(), function( data ) {
    $('#requestitem-budget_id').val(data.group_id);
    $('#requestitem-price').val(data.price);
    //$('#requestitem-quantity').val(data.quantity);
  });
  $.getJSON( "get-budget?id=" + $(this).val(), function( data ) {
    $('#requestitem-quantity').val(data);
    remain = data;
  });
});
$('#requestitem-quantity').on('keyup change',function(){
    if($(this).val() > remain){
      //alert("over");
      $(this).val(remain);
    }
});
</script>
<?php $this->endBlock() ?>
