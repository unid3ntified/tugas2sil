<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            // 'name',
            // 'password_hash',
            // 'password_reset_token',
            // 'auth_key',
            'email:email',
            'status',
            'role',
            'created_at',
            // 'updated_at',
            // 'phone',
            // 'phone2',
            // 'birthdate',
            // 'birthplace',
            // 'occupation',
            // 'gender',
            // 'country',
            // 'city',
            // 'street',
            // 'zip',
            // 'image:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
