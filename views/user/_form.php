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

    $groups = (new \yii\db\Query())
        ->select(['id', 'name'])
        ->from(['group'])
        ->all();
?>

<?php $this->registerJs('
    
'); ?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

	<?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($user, 'last_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($user, 'roleName')->radioList(
		ArrayHelper::map(
			$roles,
            'name',
            function($roles, $defaultValue) {
                return $roles['name'];
            }
		)
	) ?>
   
   <?= $form->field($assign, 'group_id')->dropDownList(
        ArrayHelper::map(
			$groups,
            'id',
            function($groups, $defaultValue) {
                return $groups['name'];
            }
		)
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
