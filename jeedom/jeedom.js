var express = require('express');
var app = express();
var MongoClient = require('mongodb').MongoClient;
var url = 'mongodb://localhost/jeedom';
var truc = '';

app.route('/lists').get(function(req, res)

    {
        MongoClient.connect(url, function(error, db) {
         if (error) return funcCallback(error);
        console.log("Connect to base mongo : jeedom");
                db.collection("arduino").find({}).toArray(function(err, result) {
                        if (err) throw err;
                        var truc = {
                                "data" : result
                        };
                        console.log(truc);
                        res.setHeader('Content-Type', 'application/json');
                        res.send(truc);
                        db.close();
                });
        });
 });

app.route('/temp-1004').get(function(req, res)

    {
        MongoClient.connect(url, function(error, db) {
         if (error) return funcCallback(error);
        console.log("Connect to base mongo : jeedom");
                db.collection("watertemperature").find().sort( { _id : -1 } ).limit(1).toArray(function(err, result) {
                        if (err) throw err;
                        var truc = {
                                "data" : result
                        };
                        console.log(truc);
                        res.setHeader('Content-Type', 'application/json');
                        res.send(truc);
                        db.close();
                });
        });
 });

var server = app.listen(3000, function() {});
