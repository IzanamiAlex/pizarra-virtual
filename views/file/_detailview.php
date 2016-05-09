<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\File */

?>

<div class="file-view">

    <?php 
    $file_location = Yii::getAlias('@web') . '/files/files/';
    $file_name = $model->file_name;
    $file_src =  $file_location . $file_name;

    $extension = pathInfo($model->file_name, PATHINFO_EXTENSION); 
    switch($extension) {
        case 'bmp':
        case 'jpeg':
        case 'jpg':
        case 'png':
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

</div>
