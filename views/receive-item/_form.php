<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RequestItem;
use yii\helpers\ArrayHelper;
$request_list = array();
$request = RequestItem::find()->all();
foreach ($request as $key => $value) {
  $check = (!isset(\app\models\ReceiveItem::findOne(['supply_id'=>$value['supply_id']])->id))?true:false;
  if($value['payment'] && $check){
    $supply = \app\models\SupplyList::findOne($value['supply_id']);
    $request_list[$value['supply_id']] = $supply->nsn." : ".$supply->name." จำนวนที่จัดหา : ".number_format($value['quantity']);
  }
}
?>

<div class="receive-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'receive_id')->hiddenInput(['value' => $_GET['rid']])->label(false) ?>

    <?= $form->field($model, 'supply_id')->widget(kartik\widgets\Select2::classname(), [
            'data' => $request_list,
            'options' => ['placeholder' => 'เลือกรายการ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('รายการพัสดุที่สามารถรับได้')
    ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number'])->label('ราคาต่อหน่วย') ?>

    <?= $form->field($model, 'quantity')->textInput(['type' => 'number'])->label('จำนวน') ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 4])->label('หมายเหตุ') ?>

    <?//= $form->field($model, 'created_at')->textInput() ?>

    <?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
var qty;
$("#receiveitem-supply_id").change(function(event) {
  $.getJSON( "get-supply?id=" + $(this).val(), function( data ) {
    $('#receiveitem-price').val(data.price);
    $('#receiveitem-quantity').val(parseInt(data.quantity));
    qty = parseInt(data.quantity);
  });
});
$("#receiveitem-quantity").on('keyup change',function(){
  if($(this).val() > qty){
    $(this).val(qty);
  }
});
</script>
<?php $this->endBlock() ?>
