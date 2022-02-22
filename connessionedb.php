<?php
//credenziali locali
$dsn = "localhost";
$username = "root";
$password = "";

//credenziali remote
//$dsn = "xx.xx.xx.xx";
//$username = "Sqlxxx";
//$password = "xxx";

// Apre la connessione con il server MySQL
$conn = mysql_connect($dsn, $username, $password);
if (! $conn){
     die('Errore durante la connessione: ' . mysql_error());
}
// Selezione del database Utenze
$db1 = mysql_select_db('randompeople', $conn);
if (!$db1) {
    die ('Accesso al database non riuscito: ' . mysql_error());
}
?>