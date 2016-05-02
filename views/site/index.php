<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

$js = <<<JS
$('#chat-form').submit(function() {

     var form = $(this);

     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               $("#message-field").val("");
          }
     });

     return false;
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY)
?>
<div class="site-index">

    <div class="body-content">


    <div class="row">
        <div class="col-md-8">
                <p class="h2"> 
                    Aqui va lo de los diagramas
                </p>
                
        </div>
        <div class="col-md-4">
                <div id="notifications" ></div>
        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chat</h3>
                            </div>
                            <div class="panel-body">
                              
                                <?= Html::beginForm(['/site/index'], 'POST', [
                    'id' => 'chat-form'
                ]) ?>
                                
                        <div class="form-group">
                            <?= Html::textInput('message', null, [
                                'id' => 'message-field',
                                'class' => 'form-control',
                                'placeholder' => 'Message'
                            ]) ?>
                        </div>
                    
                            
                                
                            
                        <div class="form-group">
                            <?= Html::submitButton('Send', [
                                'class' => 'btn btn-block btn-success'
                            ]) ?>
                        </div>                    
                        

                <?= Html::endForm() ?>
                              </div>

                        </div>
            

                
        </div>

    </div>


    </div>
</div>


