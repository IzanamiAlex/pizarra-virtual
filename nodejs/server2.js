var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);


server.listen(8890);

io.on('connection', function (socket) {

    console.log("new client connected");

    //var redisClient = redis.createClient();


    //redisClient.subscribe('notification');
    

    

    //redisClient.on("message", function(channel, message) {

      //  console.log("New message: " + message + ". In channel: " + channel);

        //socket.emit(channel, message);


    //});



    // var string = JSON.parse(message);


    socket.on('disconnect', function() {
        
    });

});
