<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $tutors = (new \yii\db\Query())
        ->select(['user_id', 'name', 'last_name', 'id'])
        ->from(['auth_assignment'])
        ->where(['item_name' => 'Tutor'])
        ->join('LEFT JOIN', 'user', 'user_id = id')
        ->all();

    //print_r($tutors);
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'tutor_id')->dropDownList(
		ArrayHelper::map(
			$tutors,
			'id',
            function($tutors, $defaultValue) {
                return $tutors['name'].' '.$tutors['last_name'];
            }
		)
	) ?>

    <!-- <?= $form->field($model, 'tutor_id')->textInput() ?> -->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
