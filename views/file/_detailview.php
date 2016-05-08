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
    ]) 
    ?>

    <?php 
    $file_location = Yii::getAlias('@web') . '/files/files/';
    $file_name = $model -> file_name;
    $file_src =  $file_location . $file_name;

    $extension = pathInfo($model->file_name, PATHINFO_EXTENSION); 
    switch($extension) {
        case 'bmp':
        case 'jpeg':
        case 'jpg':
        case 'png':
            echo '<h2>File Preview</h2>'; 
            echo Html::img($file_src);
            break;
        case 'pdf':
            echo '<iframe src="' . $file_src . '" height="1000" width="900"></iframe>';
            break; 
        case 'mp3':
            echo '<audio controls><source src="' . $file_src . '"</audio>';
            break;
        default:
            break;
        }
    ?>

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
