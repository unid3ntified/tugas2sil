<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sales Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'timestamp',
            'delivery',
            'discount',
            'total',
            // 'country',
            // 'city',
            // 'street',
            // 'zip',
            // 'status',
            // 'note:ntext',
            // 'last_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
