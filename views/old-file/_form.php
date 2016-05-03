<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $this->registerJs('
    function showGroupID()
	{
		$("[name=\'File[group_id]\']").removeAttr("disabled");
		$(".field-file-group_id").show();
	}
    
    function hideGroupID()
	{
		$("[name=\'File[group_id]\']").attr("disabled","disabled");
		$(".field-file-group_id").hide();
	}
    
    function toggleGroupID() {
        if( $("[name=\'File[group_file]\']:checked").val() == "0" )
		{
			hideGroupID();
		}
		else
		{
			showGroupID();
		}
    }
    
    $("[name=\'File[group_file]\']").change(function (){
		toggleGroupID();
	});
    
    toggleGroupID();
');?>

<div class="file-form">

    <?php $form = ActiveForm::begin([
		'layout' => 'horizontal',
		'options' => ['enctype' => 'multipart/form-data'],
	]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'board_file')->fileInput() ?>

    <?= $form->field($model, 'group_file')->radioList(
    [
        0 => 'Show all',
        1 => 'Show to group',
    ]) ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
