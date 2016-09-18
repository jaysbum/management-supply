<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplyListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$budget = app\models\BudgetGroup::findOne($group_id);
$this->title = 'รายการความต้องการพัสดุ '.$budget->name." ปีงบประมาณ ".$budget->year;
$this->params['breadcrumbs'][] = ['label' => 'รายการกลุ่มงบประมาณ', 'url' => ['/budget-group']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-list-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= "วงเงินงบประมาณ : <b>". number_format($budget->total,2) ."</b> จำนวนรายการ : <b>". $budget->count . "</b> เป็นเงิน : <b>". number_format($budget->budgetuse,2) ."</b> คงเหลือ : <b>". number_format(($budget->total - $budget->budgetuse),2)."</b>" ?>
        <br>
        <?= Html::a('สร้างรายการพัสดุ', ['create','gid'=>$group_id], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            //'group_id',
            [
              'attribute'=>'name',
              'label'=>'ชื่อพัสดุ'
            ],
            [
              'attribute'=>'nsn',
              'label'=>'หมายเลขพัสดุ',
              'contentOptions'=>['class'=>'text-center','style'=>'width: 100px;'],
            ],
            [
              'attribute'=>'unit_issue',
              'label'=>'หน่วยนับ',
              'contentOptions'=>['class'=>'text-center','style'=>'width: 100px;'],
            ],
            [
              'attribute'=>'gpsc',
              'label'=>'รหัส GPSC',
              'contentOptions'=>['class'=>'text-center','style'=>'width: 100px;'],
            ],
            [
              'attribute'=>'price',
              'label'=>'ราคาต่อหน่วย',
              'filter'=>'',
              'contentOptions'=>['class'=>'text-right','style'=>'width: 100px;'],
              'format'=>'decimal'
            ],
            [
              'attribute'=>'quantity',
              'label'=>'จำนวนที่ต้องการ',
              'filter'=>'',
              'contentOptions'=>['class'=>'text-center','style'=>'width: 100px;'],
            ],
            [
              'attribute'=>'summary',
              'label'=>'ราคารวม',
              'filter'=>'',
              'contentOptions'=>['class'=>'text-left','style'=>'width: 100px;'],
              'pageSummary' => true,
              'format'=>'decimal'
            ],
            // 'real_price',
            // 'real_quantity',
            // 'real_total',
            // 'margin_total',
            // 'status',
            // 'remark:ntext',
            // 'created_at',
            // 'updated_at',

            [
              'class' => 'kartik\grid\ActionColumn','template' => '{update} {delete}',
              'urlCreator' => function($action, $model, $key, $index) {
                return yii\helpers\Url::to([$action,'id'=>$key,'gid'=>$_GET['gid']]);
              },
            ],
        ],
    ]); ?>
</div>
