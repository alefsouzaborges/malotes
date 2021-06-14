<?php
include_once('config-database.php');
include_once('validar-usuario.php');
include_once('valida-sessao.php');

if(isset($_GET['lacre']) && !empty($_GET['lacre'])){

$lacre = addslashes($_GET['lacre']);
$hora = addslashes($_GET['hora']);
$status = "Recebido";

	try {

		$sql = "UPDATE movimentoc SET status =:status WHERE lacre =:lacre AND hora =:hora";
		$sql = $pdo->prepare($sql);
		$sql->bindParam(':lacre', $lacre);
		$sql->bindParam(':status', $status);
		$sql->bindParam(':hora', $hora);
		if($sql->execute() >0){
			echo "Dados alterado com sucesso!";
		}
		header('Location: ../listar_malotes_cabecalho.php');
		
		
		
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	
}


?>