<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

echo '<div class="col-md-6 col-md-offset-3" id="user-view">';
echo '<h2>Upload Foto</h2><br>';
$form = ActiveForm::begin([
    	'options' => [ 'enctype' => 'multipart/form-data']
	]);
echo $form->field($model,'file')->fileInput()->label('Image File (Max size: 25MB)');
echo Html::submitButton('Upload this file', ['class' => 'btn btn-sm btn-primary']);
ActiveForm::end();
echo '</div>';

?>