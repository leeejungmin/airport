
var express = require('express');
var bodyParser = require('body-parser');
// const Joi = require('joi');
var app = express();
// create application/json parser
var jsonParser = bodyParser.json();
var mysql      = require('mysql');
var cors_proxy = require('cors-anywhere');

app.use(express.json());
app.use(bodyParser.urlencoded({ extended: true}));
// Listen on a specific host via the HOST environment variable
var host = process.env.HOST || '0.0.0.0';
// juste pour changer port
const port = process.env.PORT || 7000;


cors_proxy.createServer({
    originWhitelist: [], // Allow all origins
    requireHeader: ['origin', 'x-requested-with'],
    removeHeaders: ['cookie', 'cookie2']
}).listen(port, host, function() {
    console.log('Running CORS Anywhere on ' + host + ':' + port);
});

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});


app.listen(port, () => console.log('Listening on port '+[port]+' Jungmin!!!'));

var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '111111',
  database : 'inscription',
});

connection.connect(function(error){
  if(!!error){
    console.log('Essayer! Database');
  }else{
    console.log('database connected!');
  }
});

app.get('/api/users',function(req, res){

  connection.query("SELECT * FROM user;", function(err, rows, fields) {
    if (!!err){

      console.log('Essayer!!!!!!!!!!!!!!!');
    }else{

      console.log('Success Jungmin!!\n');
      console.log(rows);
      res.json(rows);
    }

});

});

// ajouter user base de donne

app.post('/api/adduser',function(req, res){

  console.log("quest ce que c'est?");
  console.log(req.body);

  var sql = 'INSERT INTO user (username, email, password) VALUES (?,?,?);';

  var values = [
   req.body.username,
    req.body.email,
   req.body.password

  ]

  ;


  connection.query(sql, values, function(err, rows, fields) {
    if (!!err){

      console.log('Essayer!!!!!!!!!!!!!!!');
      res.json(err);
    }else{

      console.log('Success Jungmin!!\n');
      console.log(rows);
      // console.log(fields);
      // res.json(rows);
      // res.json(fields);
      // res.location('http://localhost/angularjs/login.html' );
      // res.redirect('/humans');
      res.redirect('http://localhost/angularjs/index.html#!/login');
    }

  });
});

// corriger user base de donne
//besoin user_id de pint de depart
// id = [req.params.id]
app.get('/api/user/:user_id',function(req, res){

  console.log("quest ce que c'est?");
  console.log(req.body);

  connection.query("SELECT * FROM user WHERE id ='"+ req.params.user_id+ "'", function(err, rows, fields) {
    if (!!err){

      console.log('Essayer!!!!!!!!!!!!!!!');
    }else{

      console.log('Success Jungmin!!\n');
      console.log(rows);
      res.render('http://localhost/angularjs/index.html#!/login',{
        username: req.body.username,
        email: req.body.email,
        password: req.body.password,
      });
    };

  });
});
//update
app.post('/api/user/:user_id',function(req, res){

  console.log("quest ce que c'est?");
  console.log(req.body);

  var values = [
    req.body.username,
    req.body.email,
    req.body.password,
     parseInt(req.params.user_id),
  ] ;
  // var values = {
  //   username: req.body.username,
  //   email: req.body.email,
  //   password: req.body.password,
  //   // id : parseInt(req.params.user_id)
  //
  // };

  var sql="UPDATE user SET username=?,email=?,password=? WHERE id=?"
  // var sql="UPDATE user SET ? WHERE id=?"
  connection.query(sql,values, function(err, rows, fields) {
    if (!!err){
      console.log(err);
      console.log('Essayer!!!!!!!!!!!!!!!');
      res.json(err);
    }else{

      console.log('Success Jungmin!!\n');
      console.log(rows);
      res.json();
    };

  });


});
// Delete user
app.post('/api/deluser/',function(req, res){

  console.log("quest ce que c'est?");
  console.log(req.body);

  var values = {
    username: req.body.username,

  };

  var sql = "DELETE FROM user WHERE ?";
  connection.query(sql,values, function(err, rows, fields) {
    if (!!err){

      console.log('Essayer!!!!!!!!!!!!!!!');
      res.json(err);
    }else{

      console.log('Success Jungmin!!\n');
      console.log(rows);
      // console.log(fields);
      // res.json(fields);
      res.json(rows);

    };

  });


});




// const users = [
//   { id: 1, name: 'course1'},
//   { id: 2, name: 'course2'},
//   { id: 3, name: 'course3'},
// ];
//
// app.post('/api/users', (req, res)  => {
//   console.log('Success Jungmin!!\n');
//   console.log(req);
//   var newId = !users.length ?
//   1 : users[users.length - 1].id + 1;
//
//   var user = {
//     id: newId,
//     name: req.body.name,
//   };
//   users.push(user);
//   res.json(user);
// });
//
// app.get('/api/users/:id',(req, res) => {
//   const user = users.find(c => c.id === parseInt(req.params.id));
//   if(!user) res.status(404).send('The user is not exist');
//   res.send(user);
// });

// connection.end();
