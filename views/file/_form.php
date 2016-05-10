<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Group;
use kartik\file\FileInput;

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
        if( $("[name=\'File[isGroupFile]\']:checked").val() == "0" )
		{
			hideGroupID();
		}
		else
		{
			showGroupID();
		}
    }
    
    $("[name=\'File[isGroupFile]\']").change(function (){
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

    <?php // $form->field($model, 'board_file')->fileInput() ?>

    <?= $form->field($model, 'board_file')->widget(FileInput::classname()) ?>
   
    <?= $form->field($model, 'isGroupFile')->radioList(
    [
        0 => 'Show all',
        1 => 'Show to group',
    ]) ?>

    <?= $form->field($model, 'group_id')->dropDownList(
		ArrayHelper::map(
			Group::find()->all(),
			'id',
            'name'
		)
	) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
