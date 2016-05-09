<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Assign;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $model app\models\Assign */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $tutors = (new \yii\db\Query())
        ->select(['user_id', 'name', 'last_name', 'id'])
        ->from(['auth_assignment'])
        ->where(['item_name' => 'Tutor'])
        //->where(['item_name' => 'tutor'])
        ->join('LEFT JOIN', 'user', 'user_id = id')

        ->all();

    //print_r($tutors);
    $students = (new \yii\db\Query())
        ->select(['user_id', 'name', 'last_name', 'id'])
        //->select(['username', 'name', 'last_name', 'id'])
        ->from(['auth_assignment'])
        ->where(['item_name' => 'Student'])
        //->where(['item_name' => 'tutor'])
        ->join('LEFT JOIN', 'user', 'user_id = id')
        ->all();

    $groups = (new \yii\db\Query())
        ->select(['student_id', 'group_id', 'id'])
        ->from(['assign'])
        //->where(['item_name' => 'Student'])
        ->join('LEFT JOIN', 'group', 'group_id = id')
        ->all();   
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= 
        $form->field($model, 'tutor_id')->dropDownList(
        //$form->field($model, 'id')->dropDownList(
		ArrayHelper::map(
			$tutors,
			'id',
            function($tutors, $defaultValue) {
                return $tutors['name'].' '.$tutors['last_name'];
            }
		)
	) ?>

     <!--<?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> <br>
<div>
        <h3>Estudiantes</h3>
        <?php $form = ActiveForm::begin(); ?>
    
        <?= 
            //$form->field($model, 'group_id')->dropDownList(
            $form->field($model, 'id')->dropDownList(
            ArrayHelper::map(
                $groups,
                //'id',
                'group_id',
                function($groups, $defaultValue) {
                    return $groups['name'];
                }
            )
        )  ?>

         <!--<?= $form->field($model, 'id')->textInput() ?> -->

        

        <div class="form-group">
            
        </div>

        <?php ActiveForm::end(); ?> 
    </div>
