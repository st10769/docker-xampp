<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo '<a href="login.html">Sessione scaduta, torna alla pagina di login</a>';
    exit;
}

$user_id = $_SESSION["username"];

$host = 'db';
$dbname = 'chatroom';
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

date_default_timezone_set('Europe/Rome');
$connection->query("SET time_zone = 'Europe/Rome'");

if (empty($_GET['nome_chat'])) {
    echo "Nessuna chat selezionata";
    echo '<br><a href="dashboard.php">Torna alla lista chat</a>';
    exit;
}

$chat_id = $_GET['nome_chat'];

if ($_POST && isset($_POST['messaggio'])) 
{
    $messaggio = trim($_POST['messaggio']);
    
    if (!empty($messaggio)) {
        $stmt = $connection->prepare("INSERT INTO Messaggi (nome, username, testo, giorno) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $chat_id, $user_id, $messaggio);
        
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Messaggio inviato con successo!</p>";
        } else {
            echo "<p style='color: red;'>Errore nell'invio del messaggio</p>";
        }
        $stmt->close();
    }
}

$stmt = $connection->prepare("SELECT nome FROM Stanze WHERE nome = ? LIMIT 1");
$stmt->bind_param("s", $chat_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Chat non trovata";
    exit;
}

$chat_info = $result->fetch_assoc();
$nome_chat = $chat_info['nome'];
$stmt->close();

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat: <?php echo htmlspecialchars($nome_chat); ?></title>
</head>
<body>
    <a href="stanze.php" class="back-link">← Torna alla lista chat</a>
    
    <div class="chat-header">
        <h2><?php echo htmlspecialchars($nome_chat); ?></h2>
        <p>Benvenuto, <?php echo htmlspecialchars($user_id); ?>!</p>
    </div>
    
    <div class="messages-container">
        <?php
        // Recupera tutti i messaggi della chat ordinati per data
        $stmt = $connection->prepare("SELECT username, testo, giorno FROM Messaggi WHERE nome = ? ORDER BY giorno ASC");
        $stmt->bind_param("s", $chat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo '<div class="no-messages">Nessun messaggio ancora. Inizia la conversazione!</div>';
        } else {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="message">';
                echo '<div class="message-header">';
                echo '<span class="message-sender">' . htmlspecialchars($row['username']) . '</span>';
                echo '<span class="message-date">' . date('d/m/Y H:i', strtotime($row['giorno'])) . '</span>';
                echo '</div>';
                echo '<div class="message-text">' . nl2br(htmlspecialchars($row['testo'])) . '</div>';
                echo '</div>';
            }
        }
        
        $stmt->close();
        ?>
    </div>
    
    <div class="message-form">
        <form method="POST" action="">
            <textarea 
                name="messaggio" 
                class="message-input" 
                rows="3" 
                placeholder="Scrivi il tuo messaggio..." 
                required
            ></textarea>
            <button type="submit" class="send-button">Invia Messaggio</button>
        </form>
    </div>
    
    <script>

        const messagesContainer = document.querySelector('.messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</body>
</html>

<?php
$connection->close();
?>