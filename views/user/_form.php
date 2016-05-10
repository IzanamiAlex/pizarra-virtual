<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $roles = (new \yii\db\Query())
        ->select(['name'])
        ->from(['auth_item'])
        ->all();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'roleName')->dropDownList(
		ArrayHelper::map(
			$roles,
            'name',
            function($roles, $defaultValue) {
                return $roles['name'];
            }
		)
	) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
