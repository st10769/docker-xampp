<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>
<body>
    <h1>DASHBOARD - Le mie chat</h1>
    <form action='eliminaFile.php' method='POST'>
<?php
    require "db.php";

    if(isset($_SESSION["username"]))
    {
        $user_id = $_SESSION["username"];

        $stmt = $connection->prepare("SELECT nome FROM File WHERE username_utente = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            echo "Hai "  . $result->num_rows . " file disponibili ";
            echo "<br>";
            while($row = $result->fetch_assoc())
            {
                echo "<form action='eliminaFile.php' method='POST'>";
                echo $row["nome"];
                echo "<input type='hidden' name='nomefile' value='".$row["nome"]."'>";
                echo "<button type='submit'>Elimina</button>";
                echo "<br>";
                echo "</form>";
            }
        }
        else
        {
            echo "Nessun file presente";
            echo "<br>";
            echo "Carica un file";
        }

        $stmt->close();
        $connection->close();
    }
    else
    {
        header("Location: login.php");
        exit;
    }
    ?>

    <a href="nuovoFile.php">
        <button>Carica file</button>
    </a> 
</body>
</html>