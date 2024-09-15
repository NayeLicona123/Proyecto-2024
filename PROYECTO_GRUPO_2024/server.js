const mysql = require('mysql');
const express = require('express');
const bcrypt = require('bcryptjs');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'tu_usuario',
    password: 'tu_contraseña',
    database: 'nombre_de_tu_base_de_datos'
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Conectado a la base de datos MySQL');
});

app.post('/register', (req, res) => {
    const username = req.body.username;
    const password = bcrypt.hashSync(req.body.password, 10);
    const role = req.body.role;

    const sql = `INSERT INTO users (username, password, role) VALUES (?, ?, ?)`;
    connection.query(sql, [username, password, role], (err, result) => {
        if (err) throw err;
        res.send('Usuario registrado con éxito');
    });
});

app.post('/login', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;

    const sql = `SELECT * FROM users WHERE username = ?`;
    connection.query(sql, [username], (err, results) => {
        if (err) throw err;

        if (results.length > 0) {
            const user = results[0];
            if (bcrypt.compareSync(password, user.password)) {
                res.send('Autenticación exitosa');
            } else {
                res.send('Contraseña incorrecta');
            }
        } else {
            res.send('Usuario no encontrado');
        }
    });
});

app.listen(3000, () => {
    console.log('Servidor en ejecución en el puerto 3000');
});
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});
