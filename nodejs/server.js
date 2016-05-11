var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
var MongoClient = require('mongodb').MongoClient, assert = require('assert');

server.listen(8890);

io.on('connection', function (socket) {

    console.log("new client connected");


    var redisClient = redis.createClient();
    var url = 'mongodb://localhost:27017/Chat';

    var findDocuments = function(db, callback) {
        // Get the documents collection
        var collection = db.collection('chat');
        // Find some documents
        collection.find({}).toArray(function(err, docs) {
            assert.equal(err, null);
            console.log("Found the following records");
            console.log(docs)
            callback(docs);
        });
    }


    MongoClient.connect(url, function(err, db) {
        assert.equal(null, err);
        console.log("Connected correctly to server to MongoDB");

        findDocuments(db, function() {
            db.close();
        });


    });

    //********Chat con MongoDB************



    /*MongoClient.on("message",function (channel, message) {
        console.log("New message: " + message + ". In channel: " + channel);

        socket.emit(channel, message);
    });*/


    //********Chat con redis************

    redisClient.subscribe('notification');

    redisClient.on("message", function(channel, message) {

        console.log("New message: " + message + ". In channel: " + channel);

        socket.emit(channel, message);


    });



    // var string = JSON.parse(message);
    socket.on('input',function (data) {
        console.log(data);
    });



    socket.on('disconnect', function() {
        MongoClient.quit();
    });

});
