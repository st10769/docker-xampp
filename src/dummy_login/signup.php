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

    echo "Connessione al database riuscita con mysqli!<br>";

    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO User (nome, password) VALUES ('$username', '$pass')";

    $connection->query($sql);

    $connection->close();
?> 