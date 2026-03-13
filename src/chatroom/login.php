<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['username'], $_POST['password'])) {
        die("Parametri mancanti");
    }

    $nome = $_POST['username'];
    $pass = $_POST['password'];

    $host = 'db';
    $dbname = 'chatroom';
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $stmt = $connection->prepare(
        "SELECT Password FROM Utenti WHERE Username = ?"
    );

    if (!$stmt) {
        die("Errore prepare: " . $connection->error);
    }

    $stmt->bind_param("s", $nome);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['Password'])) {
            session_start();
            $_SESSION['username'] = $nome;

            header("Location: stanze.php");
            exit;
        } else {
            echo "Login errato";
        }

    } else {
        echo "Login errato";
        echo '<a href="signUp.html">Vai alla pagina di registrazione</a>';
    }

    $stmt->close();
    $connection->close();
}
?>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
</head>
<body>

<h2>Login</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST" action="login.php">
    <label>Username:</label><br>
    <input class="input" type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input class="input" type="text" name="password"><br><br>

    <button class="button has-background-link" input type="submit">Accedi</button>
</form>

</body>
</html>
