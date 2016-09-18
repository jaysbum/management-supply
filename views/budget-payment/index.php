<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
$month = array(0=>'ทุกเดือน', 1 => 'ต.ค.', 2 => 'พ.ย.', 3 => 'ธ.ค.', 4 => 'ม.ค.', 5 => 'ก.พ.', 6 => 'มี.ค.', 7 => 'เม.ย.', 8 => 'พ.ค.', 9 => 'มิ.ย.', 10 => 'ก.ค.', 11 => 'ส.ค.', 12 => 'ก.ย.');

$this->title = 'รายการเบิกจ่ายงบประมาณ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มรายการเบิกจ่าย', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        if(Yii::$app->session->hasFlash('alert')):
          echo \yii\bootstrap\Alert::widget([
          'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
          'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
          ]);
        endif;
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [
              'attribute'=>'request_id',
              'value'=>function($data){
                return $data['request']['doc_num']."/".$data['request']['year'];
              }
            ],
            [
              'attribute'=>'quarter',
              'filterType'=> GridView::FILTER_SELECT2,
              'filterWidgetOptions'=>[
                'data'=> [0=>'ทั้งหมด',1=>1,2=>2,3=>3,4=>4],
                'options' => [
                  'prompt' => 'เลือก ...',
                ],
              ],
              'label'=>'ไตรมาส'
            ],
            [
              'attribute'=>'month',
              'filterType'=> GridView::FILTER_SELECT2,
              'filterWidgetOptions'=>[
                'data'=> $month,
                'options' => [
                  'prompt' => 'เลือก ...',
                ],
              ],
              'value'=>function($data){
                return $data['monthname'];
              },
              'label'=>'เดือนที่เบิกจ่าย'
            ],
            'year',
            'payment_date:date',
            [
              'attribute'=>'total',
              'filter'=>'',
              'label'=>'วงเงินเบิกจ่ายรวม',
              'pageSummary'=>true,
              'format'=>'decimal'
            ],

            ['class' => 'kartik\grid\ActionColumn','template' => '{delete}'],
        ],
    ]); ?>
</div>
