<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

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
    <link rel="shortcut icon" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/assets/favicon.png">
    <script src="<?php echo Yii::$app->urlManager->baseUrl; ?>/assets/tes.js"></script>
    <script>
        // insert some jquery stuff here
    </script>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                // 'brandLabel' => 'My Company',
                // 'brandUrl' => Yii::$app->homeUrl,
                // 'options' => [
                //     'class' => 'navbar-inverse navbar-fixed-top',
                // ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Daftar Baru', 'url' => ['/site/signup']] :
                        ['label' => 'Profil Saya', 'url' => ['/user/view', 'id' => Yii::$app->user->identity->id]],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

         <?php       
            echo '<div class="row" id="wrapbar"><div class="col-md-2" id="rightbar">';       
            if (!Yii::$app->user->isGuest)
            {
                if (Yii::$app->user->identity->role == 'Admin')
                {
                    echo Nav::widget([
                        'options' => ['class' => 'nav-pills nav-stacked', 'id' => 'rightmenu'],
                        'items' => [
                            ['label' => ' ', 'options' => ['id' => 'toggle']], 
                            ['label' => ' Home', 'url' => ['/site/index'], 'options' => ['id' => 'itemhome']],
                            ['label' => ' Dashboard', 'url' => ['/site/dashboard'], 'options' => ['id' => 'itemdashboard']],
                            ['label' => ' Products','url' => ['/product/index'], 'options' => ['id' => 'itemsharing']],
                            ['label' => ' Categories','url' => ['/category/index'], 'options' => ['id' => 'itemtopology']],
                            ['label' => ' Shopping Cart', 'url' => ['/shoppingcart/index'], 'options' => ['id' => 'toggle1']],
                            ['label' => ' Order', 'url' => ['/salesorder/index'], 'options' => ['id' => 'item1']],
                            ['label' => ' Discount', 'url' => ['/discount/index'], 'options' => ['id' => 'item1']],
                            ['label' => ' Delivery', 'url' => ['/delivery/index'], 'options' => ['id' => 'item1']],
                            ['label' => ' User', 'url' => ['/user/index'], 'options' => ['id' => 'item2']],
                            ['label' => ' Slider', 'url' => ['/site/slider'], 'options' => ['id' => 'item2']],
                            ['label' => ' My Shopping Cart','url' => ['/shoppingcart/view', 'user_id' => Yii::$app->user->identity->id], 'options' => ['id' => 'itemtopology']],
                            ['label' => ' My Profile', 'url' => ['/user/view', 'id' => Yii::$app->user->identity->id], 'options' => ['id' => 'item1']],
                        ],
                    ]);
                }
                else
                {
                    echo Nav::widget([
                        'options' => ['class' => 'nav-pills nav-stacked', 'id' => 'rightmenu'],
                        'items' => [
                            ['label' => ' ', 'options' => ['id' => 'toggle']],            
                            ['label' => ' Home', 'url' => ['/site/index'], 'options' => ['id' => 'itemhome']],
                            ['label' => ' All Products', 'url' => ['/product/index'], 'options' => ['id' => 'itemdashboard']],
                            ['label' => ' All Categories','url' => ['/category/index'], 'options' => ['id' => 'itemsharing']],
                            ['label' => ' My Shopping Cart','url' => ['/shoppingcart/view', 'user_id' => Yii::$app->user->identity->id], 'options' => ['id' => 'itemtopology']],
                            ['label' => ' Transaction Log', 'url' => ['/user/view', 'id' => Yii::$app->user->identity->id], 'options' => ['id' => 'item1']],           
                        ],
                    ]);
                }
            }    
            echo '</div>';
        ?>
        <div class="col-md-10" id="page-wrapper">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Yii::t('yii', 'Home'),
                    'url' => Yii::$app->homeUrl,
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
        <?= '</div>' ?>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-center">&copy; <?= date('Y').' '.Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
