<?php
$user = $_GET['username'];
$pass = $_GET['password'];

//$NOME_OK = "barto";
//$PASS_OK = "monica";

if ($user == "barto" && $pass == "monica") 
{
    echo "Login effettuato!";
} else 
{
    echo "Credenziali errate";
}
?>