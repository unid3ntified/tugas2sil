<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
    
    <?php
        if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $model->id))
        {
            echo '<div class="row">';
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ' '; 
            echo Html::a('Upload Photo', ['uploadphoto', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo ' ';
            echo Html::a('Change Password', ['changepassword', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo '</div>';
        }
    ?>
    <br>
    <?php
        if (!Yii::$app->user->isGuest && User::findOne(Yii::$app->user->id)->role == 'Admin')
        {
            echo '<div class="row">';
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this user?',
                    'method' => 'post',
                ],
            ]);
            echo ' '; 
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
            echo '</div>';
        }
        if ($model->gender == 0)
            $model->gender = 'Pria';
        else 
            $model->gender = 'Wanita';
        if ($model->status == 10)
            $model->status = 'Aktif';
        else if ($model->status == 20)
            $model->status = 'Banned';
        else
            $model->status = 'Deleted';
    ?>
    <br>

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
