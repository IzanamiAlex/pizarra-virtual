<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = $model->name;
?>
<div class="file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        //'id',
        'name',
        'description',
        [
            'label' => 'File',
            'value' => Html::a($model->file_name,'@web/files/files/'.$model->file_name),
            'format' => 'html',
        ],
    ],
]) ?>

<?php if(!empty($model->group)): ?>

<h2>Group</h2>

<?= DetailView::widget([
    'model' => $model->group,
    'attributes' => [
        'id',
        'name',  
    ],
]) ?>

<?php endif; ?>

</div>
