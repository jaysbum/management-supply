<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceiveItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการพัสดุที่ได้รับ ตามใบรับที่ '.\app\models\ReceiveSupply::findOne($_GET['rid'])->doc_num."/".\app\models\ReceiveSupply::findOne($_GET['rid'])->year;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receive-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างรายการใบรับพัสดุ', ['create','rid'=>$_GET['rid']], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'supply.nsn',
            'supply.name',
            'price',
            'quantity',
            [
              'attribute'=>'total',
              'format'=>'decimal',
              'label'=>'เป็นเงิน',
              'pageSummary'=>true
            ],
            //'remark:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'kartik\grid\ActionColumn','template'=>'{delete}',
            'urlCreator' => function($action, $model, $key, $index) {
              return yii\helpers\Url::to([$action,'id'=>$key,'rid'=>$_GET['rid']]);
            },
            ],
        ],
    ]); ?>
</div>
