<?php
session_start();

$host = 'db';
$dbname = 'chatroom';
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

if (!isset($_SESSION["username"])) {
    echo '<a href="login.html">Sessione scaduta, torna alla pagina di login</a>';
    exit;
}

$username = $_SESSION["username"];


$stmt = $connection->prepare(
    "SELECT COUNT(*) AS totale FROM Stanze WHERE username = ?"
);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo "L'utente ha le seguenti stanze: " . $row['totale'] . "<br><br>";

$stmt->close();


$query = "SELECT Nome FROM Stanze";
$result = $connection->query($query);

echo "<h3>Tutte le stanze disponibili</h3>";
echo "<ul>";

while ($row = $result->fetch_assoc()) {
    $nome_chat = htmlspecialchars($row['Nome']);
    echo "<li>
            <a href='chat.php?nome_chat=$nome_chat'>$nome_chat</a>
          </li>";
}

echo "</ul>";

$connection->close();
?>
