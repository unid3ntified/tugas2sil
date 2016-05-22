<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Manage Slider';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<?php
		if (!$model->file_id)
		{
			echo '<div class="row">
				<div class="col-md-1">#</div>
				<div class="col-md-6">Slider</div>
				<div class="col-md-2">Action</div></div>';
			foreach ($data as $key => $value) {
            	echo '<div class="row">
            	<div class="col-md-1">'.($key + 1).'</div>
            	<div class="col-md-6" id="sliderlist">'.Html::img(['/file','id'=>$value['id']]).'</div>
            	<div class="col-md-2">'.
            	Html::a('Delete', ['deleteslider', 'id' => $value['id']], ['data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ]]).'</div></div>';
        	}
        }
	?>
	<br>
	<br>
	<br>
	<div align="center">
		<?php 
	    	if ($model->file_id)
	    	{
	    		echo '<h2>Slider Added</h2><br><br>';
	    		echo Html::a('Back', ['index'], ['class' => 'btn btn-success']);
	    	}
	    	else
	    	{
	    		$form = ActiveForm::begin([
	            	'options' => [ 'enctype' => 'multipart/form-data']
	    		]);
	    		echo $form->field($model,'file')->fileInput()->label('Image File (Max size: 25MB)');
	    		echo Html::submitButton('Upload this file', ['class' => 'btn btn-sm btn-primary']);
	    		ActiveForm::end();
	    	}
		?>
	</div>
</div>