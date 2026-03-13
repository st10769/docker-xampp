<?php

//presi dal docker-compose.yml
$host = 'db'; 
$dbname = 'root_db'; 
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

echo "Connessione al database riuscita con mysqli!";
//logica
//passo1:prendo i dati della richiesta http
//passo2:costruisco le queary utilizzando i dati dell'utente
//passo3:eseguo le queary
//passo4:prendo la risposta della queary
//passo5:visualizzo i risultati
$connection->close();