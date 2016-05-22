<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;
use app\models\User;
use app\models\Category;
use app\models\Discount;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6 col-md-offset-3" id="user-view">
    <?php
        if ($notif!='')
        {
            Alert::begin(['options' => ['class' => 'alert-warning']]);
            echo $notif;
            Alert::end();
        }
    ?>
    <?= Html::img(['/file','id'=>$model->image]) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
    <?php
        if (!Yii::$app->user->isGuest && $model->stock > 0)
            echo Html::a('Add to My Cart', ['addtocart', 'id' => $model->id], ['class' => 'btn btn-primary']);    
        if (!Yii::$app->user->isGuest && User::findOne(Yii::$app->user->id)->role == 'Admin')
        {
            echo '<div class="row">';
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ' '; 
            echo Html::a('Upload Photo', ['uploadphoto', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ' ';
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this user?',
                    'method' => 'post',
                ],
            ]);
            echo '</div>';
        }
        if ($model->status == 0)
            $model->status = 'Tersedia';
        else if ($model->status == 1)
            $model->status = 'Habis';
        else if ($model->status == 2)
            $model->status = 'Inden';
        else
            $model->status = 'Arsip';

        $model->category = Category::findOne($model->category)->name;
        $model->discount = Discount::findOne($model->discount)->name;
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',            
            'name',
            'category',
            'price',
            'status',
            'discount',
            'stock',
            'description:ntext',
            //'image:ntext',  
            'dimension',
            'weight',

        ],
    ]) ?>

</div>
