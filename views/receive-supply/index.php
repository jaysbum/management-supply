<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceiveSupplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการรับพัสดุ (ทอ.74)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receive-supply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างรายการ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
              'attribute'=>'doc_num',
              'value'=>function($data){
                return $data['doc_num']."/".$data['year'];
              }
            ],
            'year',
            [
              'attribute'=>'id',
              'value'=>function($data){
                return "<a href='".yii\helpers\Url::to(['/receive-item','rid'=>$data['id']])."' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-plus'></span> เพิ่มรายการพัสดุที่ได้รับ</a>";
              },
              'format'=>'raw',
              'label'=>''
            ],
            'doc_date:date',
            [
              'attribute'=>'count',
              'label'=>'จำนวนรายการ'
            ],
            [
              'attribute'=>'total',
              'label'=>'เป็นเงิน',
              'pageSummary'=>true,
              'format'=>'decimal'
            ],
            'remark:ntext',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{delete}'],],
    ]); ?>
</div>
