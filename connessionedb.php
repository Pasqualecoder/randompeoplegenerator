<?php
function mysql_create_db($nomedb, $conn) {
    $querycrea = "CREATE DATABASE $nomedb";
    mysql_query($querycrea, $conn);
}


//credenziali locali
/*
$dsn = $_GET["address"];
$username = $_GET["username"];
$password = $_GET["password"];
$nomedb = $_GET["nomedb"];
$tablename = $_GET["tablename"]
*/

//credenziali remote
//$dsn = "xx.xx.xx.xx";
//$username = "Sqlxxx";
//$password = "xxx";

// Apre la connessione con il server MySQL
$conn = mysql_connect($address, $username, $password);
if (! $conn){
    die('Errore durante la connessione: ' . mysql_error());
}
// Selezione del database Utenze
mysql_create_db($nomedb, $conn);

$db1 = mysql_select_db($nomedb, $conn);
if (!$db1) {
    die ('Accesso al database non riuscito: ' . mysql_error());
}

$query = "CREATE TABLE IF NOT EXISTS `$tablename` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `gender` char(1) NOT NULL COMMENT 'Male or Female',
    `firstname` varchar(30) NOT NULL,
    `lastname` varchar(30) NOT NULL,
    `city` varchar(30) NOT NULL,
    `postcode` varchar(10) NOT NULL,
    `country` varchar(30) NOT NULL,
    `birth` date NOT NULL,
    `email` varchar(50) NOT NULL,
    `username` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL,
    `SHA1` varchar(40) NOT NULL,
    `phone` varchar(15) NOT NULL,
    `photo` varchar(100) NOT NULL,
    PRIMARY KEY (ID)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
if (!mysql_query($query, $conn)) {
    die ("creazione tabella impossibile");
}
?>