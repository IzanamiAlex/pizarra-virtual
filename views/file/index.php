<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\FileSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create File'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_detailview', [
                        'model' => $model,
                    ]);
                },
            ],
            //['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            [
				'label' => 'Download Link',
				'value' => function ($model) {
                    return Html::a($model->name, '@web/files/files/' . $model->file_name);     
                },
				'format' => 'raw',
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>