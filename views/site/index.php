<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
$this->title = 'Placeholder';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div id="Carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#Carousel" data-slide-to="0" class="active"></li>
              <?php
                foreach ($carousel as $key => $value) {
                  if ($key !== 0)
                    echo '<li data-target="#Carousel" data-slide-to="'.$key.'"></li>';
                }
              ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php
                // foreach ($data as $key => $value) {
                //   if ($key == 0)
                //     echo '<div class="item active">'.Html::img(['/file','id'=>$value['id']]).'</div>';
                //   else
                //     echo '<div class="item">'.Html::img(['/file','id'=>$value['id']]).'</div>';
                // }
              ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#Carousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#Carousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
    </div>
    <?php
        if ($notif!='')
        {
            Alert::begin(['options' => ['class' => 'alert-warning']]);
            echo $notif;
            Alert::end();
        }
    ?>
    <div class="row">
        <div class="col-md-12">
            <h2 align="center">New product everyday!</h2>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row" align ="right">
                <?= Html::a('View all new products', ['/product/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2 align="center">Get limited discount today!</h2>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row" align ="right">
                <?= Html::a('View all new products', ['/product/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <h2 align="center">Hot & popular items!</h2>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" align="center">
                    No product available.
                </div>
                <div class="col-md-6" align="center">
                    No product available.
                </div>
            </div>
            <div class="row" align ="right">
                <?= Html::a('View all new products', ['/product/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
