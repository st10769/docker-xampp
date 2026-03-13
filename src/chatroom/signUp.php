<?php
$nome = $_POST["nome"];
$pass = $_POST["password"];

$host = 'db'; 
$dbname = 'chatroom'; 
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

echo "Connessione al database riuscita con successo! <br>";

// 🔐 HASH della password
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $connection->prepare(
    "INSERT INTO Utenti (Username, Password) VALUES (?, ?)"
);
$stmt->bind_param("ss", $nome, $pass_hash);

if ($stmt->execute()) {
    echo "Sign up effettuato<br>";
    echo '<a href="login.html">Vai alla pagina di login</a>';
} else {
    echo "Sign up errato: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>
