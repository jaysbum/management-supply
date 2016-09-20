<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการพัสดุ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('กำหนดหมายเลขพัสดุใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nsn',
            'niin',
            'name',
            'unit_issue',
            'price:decimal',
            'gpsc',
            // 'remark',
            'created_at:date',
            'updated_at:date',

            // 'new',

            ['class' => 'yii\grid\ActionColumn',
             'template'=>'{update} {delete}',
             'contentOptions'=>[
                'noWrap' => true
              ],
            ],
        ],
    ]); ?>
</div>
