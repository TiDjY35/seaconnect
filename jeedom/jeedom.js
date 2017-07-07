var express = require('express');
var app = express();
var MongoClient = require('mongodb').MongoClient;
var url = 'mongodb://localhost/jeedom';
var data = '';


app.route('/lists').get(function(req, res)

    {
        MongoClient.connect(url, function(error, db) {
         if (error) return funcCallback(error);
        console.log("Connect to base mongo : jeedom");
                db.collection("arduino").find({}).toArray(function(err, result) {
                        if (err) throw err;
                        var data = {
                                "data" : result
                        };
                        console.log(data);
                        res.setHeader('Content-Type', 'application/json');
                        res.send(data);
                        db.close();
                });
        });
 });


//app.get('/temp/:id').get(function(req, res)
app.route('/temp/:idkey').get(function(req, res)

    {
        MongoClient.connect(url, function(error, db) {
         if (error) return funcCallback(error);
        console.log("Connect to base mongo : jeedom");
                db.collection("watertemperature").find({idkeyarduino:, req.idkey}).sort( { _id : -1 } ).limit(1).toArray(function(err, result) {
                        if (err) throw err;
                        var data = {
                                "data" : result
                        };
                        console.log(data);
                        res.setHeader('Content-Type', 'application/json');
                        res.send(data);
                        db.close();
                });
        });
 });

var server = app.listen(3000, function() {});