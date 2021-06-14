<?php
require('config-database.php');
session_start();

if(isset($_GET['id'])){
	$id = addslashes($_GET['id']);
	
	unset($_SESSION['id']);

	$sql = "UPDATE usuarios SET online = 'N' WHERE id =$id";
	$sql = $pdo->prepare($sql);
	$sql->execute();


	header('Location: ../login.php');

}

?>