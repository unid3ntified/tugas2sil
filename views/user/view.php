<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this user?',
                'method' => 'post',
            ],
        ]) ?>
        <?php
            if (!Yii::$app->user->isGuest && User::findOne(Yii::$app->user->id)->role == 'Admin')
            {
                echo Html::a('Ban', ['ban', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Are you sure you want to ban this user?',
                        'method' => 'post',
                    ],
                ]);
                echo ' ';
                echo Html::a('Promote', ['promote', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Are you sure you want to promote this user?',
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'name',
            //'password_hash',
            //'password_reset_token',
            //'auth_key',
            'email:email',
            'status',
            'role',
            'created_at',
            'updated_at',
            'phone',
            'phone2',
            'birthdate',
            'birthplace',
            'occupation',
            'gender',
            'country',
            'city',
            'street',
            'zip',
            //'image:ntext',
        ],
    ]) ?>

</div>
