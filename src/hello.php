<h1> Hello world! </h1>

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

    $nome="mario";
    $password="ciaociao";

    $query= "SELECT * FROM User WHERE nome='$nome' AND password='$password'";

    $result = $connection->query($query);
    echo "<br>";
    echo $query;
    
    $result = $connection->query($query);
    //var_dump($result);
    echo "<br>";
    if($result->num_rows > 0){
        echo "login effettutato";
    }
    else{
        echo "login fallito";
    }
    $connection->close();
?>