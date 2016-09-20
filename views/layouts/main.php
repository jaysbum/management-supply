<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use kartik\icons\Icon;
Icon::map($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    .hero-widget { text-align: center; padding-top: 20px; padding-bottom: 20px; }
    .hero-widget .icon { display: block; font-size: 96px; line-height: 96px; margin-bottom: 10px; text-align: center; }
    .hero-widget var { display: block; height: 64px; font-size: 64px; line-height: 64px; font-style: normal; }
    .hero-widget label { font-size: 17px; }
    .hero-widget .options { margin-top: 10px; }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ระบบจัดดำเนินงาน ผจง.กพพ.พธ.ทอ.',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            /*[
                'label' => Icon::show('bar-chart') .'งานกำหนดแผน',
                'items' => [
                     '<li class="dropdown-header">ชั้นประมาณการ</li>',
                     ['label' => 'จัดทำงบประมาณและแผน', 'url' => Url::to(['/budget-group']) ],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">ชั้นแจ้งความต้องการให้จัดหา</li>',
                     ['label' => 'รายการแจ้งความต้องการ', 'url' => Url::to(['/request-supply']) ],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">ชั้นจัดหา</li>',
                     ['label' => 'รายการเบิกจ่ายงบประมาณ', 'url' => Url::to(['/budget-payment']) ],
                     ['label' => 'รายการรับพัสดุ (ทอ.74)', 'url' => Url::to(['/receive-supply']) ],
                ],
            ],*/
            [
                'label' => Icon::show('line-chart') .'งานติดตามแผน',
                'items' => [
                     '<li class="dropdown-header">ชั้นประมาณการ</li>',
                     ['label' => 'จัดทำงบประมาณและแผน', 'url' => Url::to(['/budget-group']) ],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">ชั้นแจ้งความต้องการให้จัดหา</li>',
                     ['label' => 'รายการแจ้งความต้องการ', 'url' => Url::to(['/request-supply']) ],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">ชั้นจัดหา</li>',
                     ['label' => 'รายการเบิกจ่ายงบประมาณ', 'url' => Url::to(['/budget-payment']) ],
                     ['label' => 'รายการรับพัสดุ (ทอ.74)', 'url' => Url::to(['/receive-supply']) ],
                ],
            ],
            [
                'label' => Icon::show('sort-numeric-asc') .'งานกำหนดหมายเลข',
                'items' => [
                    [ 'label' => 'กำหนดหมายเลขพัสดุ' , 'url' => Url::to(['/catalog-item']) ],
                    [ 'label' => 'กลุ่มพัสดุ' , 'url' => Url::to(['/catalog-group']) ],
                ],
            ],
            //['label' => 'About', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => Icon::show('lock') .'เข้าสู่ระบบ', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ระบบจัดดำเนินงาน ผจง.กพพ.พธ.ทอ. ๒๕๕๙</p>

        <p class="pull-right">จัดทำระบบโดย น.ต.จตุจักร ไชยงค์ หน.ฝกม.ผจง.กพพ.พธ.ทอ.</p>
    </div>
</footer>

<?php $this->endBody() ?>
<?= $this->blocks['script'] ?>
<script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);
</script>
</body>
</html>
<?php $this->endPage() ?>
