<?php
    session_start();
    if(isset($_SESSION['auth']) && $_SESSION['auth'] && $_POST && isset($_POST['nomeGiocattolo']) && isset($_POST['nomeElfo'])){
        $host = 'db';
        $dbname = 'babbonatale';
        $username = 'user';
        $password = 'user';
        $port = 3306;

        $connection = new mysqli($host, $username, $password, $dbname, $port);

        if($connection->connect_error){
            echo "Errore di connessione al database: " . $connection->connect_error;
        }
    }

    $nomeGiocattolo = $_POST['nomeGiocattolo'];
    $nomeElfo = $_POST['nomeElfo'];

    //ci esponiamo alla SQL injection, bisognerebbe utilizzare il metodo prepare
    $query = "INSERT INTO giocattoli (nomeGiocattolo, nomeElfo) VALUES ('" . $nomeGiocattolo . "', '" . $nomeElfo . "')";

    if($connection->query($query)
?>