var express = require('express');
var bodyParser = require('body-parser');
// const Joi = require('joi');
var app = express();
// create application/json parser
var jsonParser = bodyParser.json();
var mysql      = require('mysql');

app.use(express.json());
// juste pour changer port
const port = process.env.PORT || 3000;
app.listen(port, () => console.log('Listening on port '+[port]+' Jungmin!!!'));

const users = [
  { id: 1, name: 'course1'},
  { id: 2, name: 'course2'},
  { id: 3, name: 'course3'},
];




app.get('/', function (req, res) {
  res.send('Hello World!');
});


app.get('/api/users',(req, res) => {
  res.send(users);

});

app.get('/api/users/:id',(req, res) => {
  const user = users.find(c => c.id === parseInt(req.params.id));
  if(!user) res.status(404).send('The user is not exist');
  res.send(user);
});


app.get('/api/users/pa', jsonParser,(req, res) => {
  // if (!req.body) return res.sendStatus(400);
  // res.send('Hello World! jungmin!!');
  res.send(['lee','jung','min']);
  // create user in req.body
});






// complique
app.post('/api/users', (req, res)  => {
  var newId = !users.length ?
      1 : users[users.length - 1].id + 1;
  // const schema = {
  //   name: Joi.string().min(3).required()
  // };
  //
  // const result = Joi.validate(req.body, schema);
  // console.log(result);
  //
  //
  //
  // if(!req.body.name || req.body.name.length < 3){
  //
  //   res.status(400).send('Name is required and mininum shoud be 3');
  //   return;
  // }
  var user = {
    id: newId,
    name: req.body.name,
  };
  users.push(user);
  res.json(user);
});

//   const course = {
//     id: users.length + 1,
//     name: req.body.name
//   };
//   course.push(course);
//   res.send(course);
// });










app.get('/api/users/:id',(req, res) => {
  res.send(req.params.id);

});






// app.listen(3000, function () {
//   console.log('Example app listening on port 3000! Jungmin!!!');
// });

// app.get('/api/users',(req, res) => {
//   res.send([1,2,3,4,5]);
//
// });
