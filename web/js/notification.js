$( document ).ready(function() {

    var socket = io.connect('http://localhost:8890');

    //socket.emit('grupo',{hello:'world'});
    var grupo = $("#grupo").val();
    
    socket.on(grupo, function (data) {

        var message = JSON.parse(data);

        $( "#notifications" ).append( "<p><strong>" + message.name + "</strong>: " + message.message + "</p>" );

    });


    

});
