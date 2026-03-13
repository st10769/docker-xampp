<?php
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt=$connection->prepare("SELECT * FROM Abitanti WHERE CF = ? AND Data_nascita = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        session_start();
        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Credenziali non valide";
    }
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