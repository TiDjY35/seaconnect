var http = require('http');
var url = require('url');
var mysql = require("mysql");

var app = http.createServer(function(req,res){
        var page = url.parse(req.url).pathname;
        console.log(page);
        res.setHeader('Content-Type', 'application/json');
        res.setHeader("Access-Control-Allow-Origin", "*");
        res.setHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

                // First you need to create a connection to the db
                var con = mysql.createConnection({
                host: "localhost",
                user: "root",
                password: "rootsan",
                database: "radio"
                });

                con.connect(function(err){
                if(err){
                console.log('Error connecting to Db');
                return;
                }
                console.log('Connection established');
                });
                if (page == '/') {
                        res.write('Vous êtes à l\'accueil, que puis-je pour vous ?');
                        res.end();
                }
                else if (page == '/liste') {
                        con.query('SELECT * FROM arduino',function(err,rows){
                        if(err) throw err;

                        console.log('Data received from Db:\n');
                        console.log(rows);

                        res.write(JSON.stringify(rows));
                        res.end();
                        });
                }
                else if (page == '/dashboard') {
                        con.query('SELECT listtemp.nameaquarium, count(nameaquarium), tempC, tempDate from (select C.nameaquarium, T.temperature as tempC, T.date as tempDate from radio.arduino C JOIN radio.watertemperature T ON C.idkeyarduino = T.idkeyarduino order by tempDate desc) listtemp group by listtemp.nameaquarium',function(err,rows){
                        if(err) throw err;

                        console.log('Data received from Db:\n');
                        console.log(rows);

                        res.write(JSON.stringify(rows));
                        res.end();
                        });
                }
//              res.end();

                con.end(function(err) {
                });
});
app.listen(3001);
