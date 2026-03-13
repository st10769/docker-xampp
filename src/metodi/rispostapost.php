<?php
$user = $_POST['username'];
$pass = $_POST['password'];

$NOME_OK = "barto";
$PASS_OK = "monica";

if ($user === $NOME_OK && $pass === $PASS_OK) 
{
    echo "Login effettuato!";
} else 
{
    echo "Credenziali errate";
}
?>