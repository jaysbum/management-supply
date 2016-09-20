<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่มพัสดุ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างกลุ่มพัสดุใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'parent_id',
            //'list_item:ntext',
            //'created_at',
            // 'updated_at',
             'start_niin',
             'end_niin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
