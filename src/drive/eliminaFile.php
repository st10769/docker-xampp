<?php
session_start();

require "db.php";

if(isset($_SESSION["username"]))
{
    $session_id = $_SESSION["username"];
    var_dump($_POST);

    $stmt = $connection->prepare("DELETE * FROM File WHERE nome = ?");
    $stmt->bind_param("s", $_POST["nomefile"]);
    $stmt->execute();

    if($stmt->affected_rows > 0)
    {
        echo "File eliminato con successo";
        header("Location: dashboard.php");
        exit;
    }
    else
    {
        echo "File non eliminato";
        header("Location: dashboard.php");
        exit;
    }
}
?>