<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplyList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->hiddenInput(['value'=>$_GET['gid']])->label(false) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 2])->label('ชื่อพัสดุ') ?>

    <?= $form->field($model, 'nsn')->widget(\kartik\widgets\Typeahead::classname(), [
            'name' => 'nsn',
            'options' => ['placeholder' => 'ค้นหาจากหมายเลขและชื่อพัสดุ ...'],
            'pluginOptions' => ['highlight'=>true],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'value' => 'id',
                    //'prefetch' => $baseUrl . '/samples/countries.json',
                    'remote' => [
                        'url' => yii\helpers\Url::to(['nsn-list']) . '?q=%QUERY',
                        'wildcard' => '%QUERY'
                    ]
                ]
            ],
            'pluginEvents' => [
                "typeahead:selected" => "function(obj, item) {
                    var gpsc;
                    $.getJSON( 'supply-list?q=' + item['id'] , function( data ) {
                      $('#supplylist-name').val(data.name);
                      $('#supplylist-gpsc').val(data.gpsc);
                      $('#supplylist-price').val(data.price);
                      $('#supplylist-unit_issue').val(data.unit_issue);
                    });
                    return true;
                }",
            ],
        ])
    ?>
      <div class="row">
        <div class="col-md-3">
          <?= $form->field($model, 'unit_issue')->textInput(['maxlength' => true])->label('หน่วยนับ') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'gpsc')->textInput(['maxlength' => true])->label('รหัส GPSC') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'price')->textInput(['type' => 'number'])->label('ราคาต่อหน่วย') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'quantity')->textInput(['type' => 'number'])->label('จำนวนที่ต้องการ') ?>
        </div>
      </div>

    <?= $form->field($model, 'remark')->textarea(['rows' => 3])->label('หมายเหตุ') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
