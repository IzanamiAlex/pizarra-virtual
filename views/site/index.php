<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Pizarra Virtual';

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

        <?php
        echo"<input id='grupo' type='text' hidden value='".$grupo."'>";
        ?>

    <div class="row">
        <div class="col-md-8">
                <p class="h2"> 
                    Aqui va lo de los diagramas
                </p>
                
        </div>
        <div class="col-md-4">
                <div id="notifications" style="width:auto; height: 240px; overflow: scroll">
                    <?php
                    
                    if(!empty($mensajes)){
                        //for($i=4;$i>=0;$i--){

                          //  echo "<p><strong>".$mensajes[$i]['username']."</strong>: ".$mensajes[$i]['message']."</p>";
                        //}
                        foreach($mensajes as $mensaje){
                            echo "<p><strong>".$mensaje['username']."</strong>: ".$mensaje['message']."</p>";
                        }
                    }else{
                        echo "<p><strong>INICIA SESIÓN PARA VER LOS MENSAJES DEL GRUPO ASIGNADO</strong></p>";
                    }

                    /*foreach ($mensajes as $mensaje){
                        echo "<p><strong>".$mensaje['username']."</strong>: ".$mensaje['message']."</p>";
                    }*/
                    ?>
                    

                    
                </div>
                
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


