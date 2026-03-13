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

    $username = htmlspecialchars ($_POST['username']);
    $pass = htmlspecialchars ($_POST['password']);

    $stmt=$connection->prepare("SELECT * FROM User WHERE nome=? AND password=?");

    $stmt->bind_param("ss", $username, $pass);

    $stmt->execute();

    $result = $stmt->get_result();

    echo "<br>";
        //var_dump($result);
    echo "<br>";
    if($result->num_rows > 0){
        echo "login effettutato";
        if($username=="barto")
        {
            $queary="SELECT * FROM User";
            $result = $connection->query($queary);
            echo "La teballa user contiene le seguenti righe: $result->num_rows<br>";
            echo "<table border=1>";
            echo "<th>";
            echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>Password</th>";
            echo "</tr>";
            while($row = $result->fetch_assoc())
            {
               //var_dump($row);
               echo "<tr>";
               echo "<td>".$row['Nome']. "</td>";
               echo "<td>".$row['Password']. "</td>";
               echo "</tr>";
               echo "<br>";
            }
            echo "</th>";
            echo "</table>";
        }
    }
    else{
        echo "login de merda";
        echo "<br>";
        echo '<a href="signup.html">Sign Up</a>';
    }
    $connection->close();
?>