<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\RequestSupply;

$request = RequestSupply::findOne($_GET['rid']);

$this->title = 'รายการพัสดุตามใบแจ้ง';
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งความต้องการ', 'url' => ['/request-supply']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-item-index">

    <h1><?= Html::encode($this->title) ?> เลขที่ <?= $request->doc_num."/".$request->year ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างรายการ', ['create','rid'=>$_GET['rid']], ['class' => 'btn btn-success']) ?>
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
            ['attribute'=>'supply.nsn','label'=>'หมายเลขพัสดุ'],
            ['attribute'=>'supply.name','label'=>'ชื่อพัสดุ'],
            //'request_id',
            'budget.name',
            ['attribute'=>'price','format'=>'decimal','filter'=>''],
            ['attribute'=>'quantity','format'=>'decimal','filter'=>''],
            ['attribute'=>'id',
             'value'=>function($data){
               return $data['price'] * $data['quantity'];
             },
             'label'=>'รวม',
             'format'=>'decimal',
             'filter'=>'',
             'pageSummary'=>true,
            ],
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
              'class' => 'kartik\grid\ActionColumn','template' => '{update} {delete}',
              'urlCreator' => function($action, $model, $key, $index) {
                return yii\helpers\Url::to([$action,'id'=>$key,'rid'=>$_GET['rid']]);
              },
            ],
        ],
    ]); ?>
</div>
