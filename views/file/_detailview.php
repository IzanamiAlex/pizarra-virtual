<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use wahyugnc\pdfjs\ViewerPDF; 

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
    $extension = pathInfo($model->file_name, PATHINFO_EXTENSION); 

        switch($extension) {
            case 'bmp':
            case 'jpeg':
            case 'jpg':
            case 'png':
                echo '<h2>File Preview</h2>'; 
                echo Html::img(Yii::getAlias('@web').'/files/files/'. $model->file_name);
                break;
            case 'pdf':
                echo '<iframe src="'.Yii::getAlias('@web').'/files/files/'.$model->file_name.'" height="1000" width="900"></iframe>';
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
