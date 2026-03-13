<?php
session_start();

// Controllo sicuro della sessione
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {

    // Inserimento nome giocattolo e nome elfo
    echo '<section>';
    echo '<form name="Giocattoli_POST" method="POST" action="prodGioc.php">';
    echo '<label for="nome_giocattolo"> Nome giocattolo </label>';
    echo '<input type="text" id="nomeGiocattolo" name="nomeGiocattolo">';
    echo '<label for="nome_elfo"> Nome elfo </label>';
    echo '<input type="text" id="nomeElfo" name="nomeElfo">';
    echo '<button type="submit"> Inserisci </button>';
    echo '</form>';
    echo '</section>';

    //visualizzare tabella giocattoli
    echo '<section>';
    echo '<a href=prodElfi> Visualizza i giocattoli degli elfi </a>';
    echo '<br>';
    echo '</section>';

} else {
    echo "Accesso negato. Effettua il login.";
}
