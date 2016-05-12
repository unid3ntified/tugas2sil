<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var #toggle & #toggle0 for right menubar */
/* @var #toggle1 for network data menu */
/* @var #toggle2 for network information menu */
/* @var #toggle3 & #toggle4 for chart display */
/* @var #toggle5 for capacity dimensioning menu */

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
        $(document).ready(function(){
            if(typeof(Storage)!=="undefined")
            {
            /*
                initializing session storage.
            */
                if (sessionStorage.flag1==null)
                    sessionStorage.flag1="0";
                if (sessionStorage.flag2==null)
                    sessionStorage.flag2="0";
                if (sessionStorage.flag3==null)
                    sessionStorage.flag3="0";
                if (sessionStorage.nav==null)
                    sessionStorage.nav="1";
            }
            else
            {
                document.getElementById("flag1").innerHTML="Sorry, your browser does not support web storage...";
            }
            
            if (sessionStorage.flag1=="0")
            {
                $("#item1").hide();
                $("#item2").hide();
                $("#item3").hide();
                $("#item4").hide();
                $("#item14").hide();
                $("#toggle5").hide();
                $("#item15").hide();
                $("#item16").hide();
                $("#item17").toggle(320);
                $("#item18").toggle(320);
            }
            if (sessionStorage.flag2=="0")
            {
                $("#item5").hide();
                $("#item6").hide();
                $("#item7").hide();
                $("#item8").hide();
                $("#item9").hide();
                $("#item10").hide();
                $("#item11").hide();
                $("#item12").hide();
                $("#item13").hide();
            }
            if (sessionStorage.flag3=="0")
            {
                $("#item15").hide();
                $("#item16").hide();
            }
                $("#chart1").hide();
                $("#chart2").hide();

            if (sessionStorage.nav=="0")
            {
                $("#rightbar").hide();
                document.getElementById("page-wrapper").className="col-md-12";               
            }

            $("#toggle1").click(function(){
                $("#item1").toggle(320);
                $("#item2").toggle(320);
                $("#item3").toggle(320);
                $("#item4").toggle(320);
                $("#item14").toggle(320);
                $("#item17").toggle(320);
                $("#item18").toggle(320);
                $("#toggle5").toggle(320);
                if (sessionStorage.flag3=="1")
                {
                    $("#item15").toggle(320);
                    $("#item16").toggle(320);
                }
                if (sessionStorage.flag1=="0")
                    sessionStorage.flag1="1";
                else
                    sessionStorage.flag1="0";
               
               if (sessionStorage.flag2=="1")
                {
                    sessionStorage.flag2="0";
                    $("#item5").toggle(320);
                    $("#item6").toggle(320);
                    $("#item7").toggle(320);
                    $("#item8").toggle(320);
                    $("#item9").toggle(320);
                    $("#item10").toggle(320);
                    $("#item11").toggle(320);
                    $("#item12").toggle(320);
                    $("#item13").toggle(320);

                }
            });

            $("#toggle2").click(function(){
                if (sessionStorage.flag1=="1")
                {
                    sessionStorage.flag1="0";
                    $("#item1").toggle(320);
                    $("#item2").toggle(320);
                    $("#item3").toggle(320);
                    $("#item4").toggle(320);
                    $("#item14").toggle(320);
                    $("#item17").toggle(320);
                    $("#item18").toggle(320);
                    $("#toggle5").toggle(320);
                    if (sessionStorage.flag3=="1")
                    {
                        $("#item15").toggle(320);
                        $("#item16").toggle(320);
                    }
                }

                $("#item5").toggle(320);
                $("#item6").toggle(320);
                $("#item7").toggle(320);
                $("#item8").toggle(320);
                $("#item9").toggle(320);
                $("#item10").toggle(320);
                $("#item11").toggle(320);
                $("#item12").toggle(320);
                $("#item13").toggle(320);
                if (sessionStorage.flag2=="0")
                    sessionStorage.flag2="1";
                else
                    sessionStorage.flag2="0";
            });

            $("#toggle5").click(function(){
                $("#item15").toggle(320);
                $("#item16").toggle(320);
                if (sessionStorage.flag3=="1")
                    sessionStorage.flag3="0";                   
                else
                    sessionStorage.flag3="1";
            });

            $("#toggle3").click(function(){
                $("#chart2").hide();
                $("#chart1").show(640);

            });

            $("#toggle4").click(function(){
                $("#chart1").hide();
                $("#chart2").show(640);

            });

             $("#toggle0").click(function(){
                $("#rightbar").toggle(320);
                $("#toggle0").hide();
                if (sessionStorage.nav=="0")
                {
                    document.getElementById("page-wrapper").className="col-md-10";
                    sessionStorage.nav="1";
                }
                else
                {
                    document.getElementById("page-wrapper").className="col-md-12";
                    sessionStorage.nav="0";
                }
            });

            $("#toggle").click(function(){
                $("#rightbar").toggle(320);
                $("#toggle0").show();
                if (sessionStorage.nav=="0")
                {
                    document.getElementById("page-wrapper").className="col-md-10";
                    sessionStorage.nav="1";
                }
                else
                {
                    document.getElementById("page-wrapper").className="col-md-12";
                    sessionStorage.nav="0";
                }
            });
        });
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                //'brandLabel' => 'Toggle',
                //'brandUrl' => Yii::$app->homeUrl,
                //'options' => [
                   //'class' => 'navbar-inverse navbar-fixed-top',
               //],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                        ['label' => '', 'options' => ['id' => 'toggle0']],
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [                      
                    Yii::$app->user->isGuest ?
                        ['label' => ''] :
                        ['label' => ' Change Password', 'url' => ['/user/update'], 'options' => ['id' => 'cpicon']],            
                    Yii::$app->user->isGuest ?
                        ['label' => ' Login', 'url' => ['/site/login'], 'options' => ['id' => 'officon']] :
                        ['label' => ' Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                            'options' => ['id' => 'officon']],            
                ],
            ]);
            NavBar::end();
        ?>

        <?php       
            echo '<div class="row" id="wrapbar"><div class="col-md-2" id="rightbar">';       
            if (!Yii::$app->user->isGuest)
            {
                echo Nav::widget([
                    'options' => ['class' => 'nav-pills nav-stacked', 'id' => 'rightmenu'],
                    'items' => [
                        ['label' => ' ', 'options' => ['id' => 'toggle']], 
                        ['label' => ' Home', 'url' => ['/site/index'], 'options' => ['id' => 'itemhome']],
                        ['label' => ' Dashboard', 'url' => ['/site/dashboard'], 'options' => ['id' => 'itemdashboard']],
                        ['label' => ' Knowledge Sharing','url' => ['/sharing/index'], 'options' => ['id' => 'itemsharing']],
                        ['label' => ' Network Topology','url' => ['/sharing/topology'], 'options' => ['id' => 'itemtopology']],
                        ['label' => ' Network Data', 'options' => ['id' => 'toggle1']],
                        ['label' => 'Network Element', 'url' => ['/networkelement/index'], 'options' => ['id' => 'item1']],
                        ['label' => 'Interconnection Trunk', 'url' => ['/trunkinterkoneksi/index'], 'options' => ['id' => 'item2']],
                        ['label' => 'Capacity Dimensioning', 'options' => ['id' => 'toggle5']],
                        ['label' => 'MSC', 'url' => ['/capdimensioning/index'], 'options' => ['id' => 'item15']],
                        ['label' => 'SGSN', 'url' => ['/sgsncapdimensioning/index'], 'options' => ['id' => 'item16']],
                        ['label' => 'RNC Reference', 'url' => ['/rncreference/index'], 'options' => ['id' => 'item17']],
                        ['label' => 'VOIP Trunk', 'url' => ['/trunkvoip/index'], 'options' => ['id' => 'item3']],
                        ['label' => 'BSC', 'url' => ['/bsc/index'], 'options' => ['id' => 'item18']],
                        ['label' => 'POI', 'url' => ['/poi/index'], 'options' => ['id' => 'item4']],                                               
                        ['label' => ' Download','url' => ['/site/download'], 'options' => ['id' => 'item14']],
                        ['label' => ' Network Information', 'options' => ['id' => 'toggle2']],
                        ['label' => 'GT Rule', 'url' => ['/gtrule/index'], 'options' => ['id' => 'item13']],
                        ['label' => 'GT Proposed List', 'url' => ['/gtproposedlist/index'], 'options' => ['id' => 'item5']],
                        ['label' => 'SPC Rule', 'url' => ['/spcrule/index'], 'options' => ['id' => 'item6']],
                        ['label' => 'SPC Ran Sharing', 'url' => ['/spcransharing/index'], 'options' => ['id' => 'item7']],
                        ['label' => 'SCT Port Huawei', 'url' => ['/sctporthuawei/index'], 'options' => ['id' => 'item8']],
                        ['label' => 'MSRN Rule', 'url' => ['/msrnrule/index'], 'options' => ['id' => 'item9']],
                        ['label' => 'MSRN Routing', 'url' => ['/msrnrouting/index'], 'options' => ['id' => 'item10']],
                        ['label' => 'MSRN Proposed List', 'url' => ['/msrnproposedlist/index'], 'options' => ['id' => 'item11']],
                        ['label' => 'PABX Info', 'url' => ['/pabxinfo/index'], 'options' => ['id' => 'item12']],
                        ['label' => ' Manage Admin', 'url' => ['/user/index'], 'options' => ['id' => 'itemadmin']],
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
                        ['label' => ' Dashboard', 'url' => ['/site/dashboard'], 'options' => ['id' => 'itemdashboard']],
                        ['label' => ' Knowledge Sharing','url' => ['/sharing/index'], 'options' => ['id' => 'itemsharing']],
                        ['label' => ' Network Topology','url' => ['/sharing/topology'], 'options' => ['id' => 'itemtopology']],
                        ['label' => ' Network Data', 'options' => ['id' => 'toggle1']],
                        ['label' => 'Network Element', 'url' => ['/networkelement/index'], 'options' => ['id' => 'item1']],
                        ['label' => 'Interconnection Trunk', 'url' => ['/trunkinterkoneksi/index'], 'options' => ['id' => 'item2']],
                        ['label' => 'Capacity Dimensioning', 'options' => ['id' => 'toggle5']],
                        ['label' => 'MSC', 'url' => ['/capdimensioning/index'], 'options' => ['id' => 'item15']],
                        ['label' => 'SGSN', 'url' => ['/sgsncapdimensioning/index'], 'options' => ['id' => 'item16']],
                        ['label' => 'RNC Reference', 'url' => ['/rncreference/index'], 'options' => ['id' => 'item17']],
                        ['label' => 'VOIP Trunk', 'url' => ['/trunkvoip/index'], 'options' => ['id' => 'item3']],
                        ['label' => 'BSC', 'url' => ['/bsc/index'], 'options' => ['id' => 'item18']],
                        ['label' => 'POI', 'url' => ['/poi/index'], 'options' => ['id' => 'item4']],                       
                        ['label' => ' Download','url' => ['/site/download'], 'options' => ['id' => 'item14']],
                        ['label' => ' Network Information', 'options' => ['id' => 'toggle2']],
                        ['label' => 'GT Rule', 'url' => ['/gtrule/index'], 'options' => ['id' => 'item13']],
                        ['label' => 'GT Proposed List', 'url' => ['/gtproposedlist/index'], 'options' => ['id' => 'item5']],
                        ['label' => 'SPC Rule', 'url' => ['/spcrule/index'], 'options' => ['id' => 'item6']],
                        ['label' => 'SPC Ran Sharing', 'url' => ['/spcransharing/index'], 'options' => ['id' => 'item7']],
                        ['label' => 'SCT Port Huawei', 'url' => ['/sctporthuawei/index'], 'options' => ['id' => 'item8']],
                        ['label' => 'MSRN Rule', 'url' => ['/msrnrule/index'], 'options' => ['id' => 'item9']],
                        ['label' => 'MSRN Routing', 'url' => ['/msrnrouting/index'], 'options' => ['id' => 'item10']],
                        ['label' => 'MSRN Proposed List', 'url' => ['/msrnproposedlist/index'], 'options' => ['id' => 'item11']],
                        ['label' => 'PABX Info', 'url' => ['/pabxinfo/index'], 'options' => ['id' => 'item12']],            
                    ],
                ]);
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
            <p class="pull-center">&copy; 2015 Fasilkom UI </p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
