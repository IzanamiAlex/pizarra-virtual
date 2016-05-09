<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Assign */

$this->title = Yii::t('app', 'Create Assign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
