var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
var mysql      = require('mysql');






server.listen(8890);





io.on('connection', function (socket) {

    var redisClient = redis.createClient();

    var connection = mysql.createConnection({
        host     : 'localhost',
        user     : 'root',
        password : '',
        database : 'ajax'
    });



    console.log("new client connected");
    connection.connect();
    connection.query('SELECT * FROM `group` ', function(err, rows, fields) {
        if (err) throw err;
        rows.forEach(function(value, index){
            //console.log('The solution is: ', value.name);
            redisClient.subscribe(value.name);
        });


        //console.log('The solution is: ', rows[0].name);
    });





    
    
    redisClient.on("message", function(channel, message) {


        console.log("New message: " + message + ". In channel: " + channel);

        socket.emit(channel, message);


    });



    // var string = JSON.parse(message);
    //socket.on('input',function (data) {
      //  console.log(data);
    //});



    socket.on('disconnect', function() {
        connection.end();
        redisClient.quit();
    });

});
