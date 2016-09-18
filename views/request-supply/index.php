<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSupplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการแจ้งความต้องการ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-supply-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างรายการแจ้งความต้องการ', ['create'], ['class' => 'btn btn-success']) ?>
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
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [ 'attribute'=>'doc_num',
              'value'=>function($data){
                return $data['doc_num']."/".$data['year'];
              }
            ],
            'year',
            [ 'attribute'=>'doc_num',
              'value'=>function($data){
                return '<a href="'.yii\helpers\Url::to(['/request-item','rid'=>$data['id']]).'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-plus"></span> รายการพัสดุที่แจ้ง</a>';
              },
              'format'=>'raw'
            ],
            'doc_date:date',
            ['attribute'=>'count','label'=>'รายการ'],
            ['attribute'=>'total','label'=>'เป็นเงิน','format'=>'decimal'],
            //'status',
            // 'remark:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'kartik\grid\ActionColumn','template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
