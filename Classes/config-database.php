<?php
$dsn = "mysql:dbname=malote;host=localhost";
$dbuser = "root";
$dbpass = "vertrigo";


try {

	$pdo = new PDO($dsn,$dbuser,$dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

	echo "Falha...".$e->getMessage();

}





?>