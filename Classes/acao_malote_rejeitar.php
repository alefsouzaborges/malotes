<?php
include_once('validar-usuario.php');
include_once('valida-sessao.php');
include_once('config-database.php');
$motivo = $_POST['motivo'];
$lacre = $_POST['lacre'];
$hora = $_POST['hora'];

if(isset($_POST['lacre']) && !empty($_POST['lacre'])){

$lacre = addslashes($_POST['lacre']);
$motivo = addslashes($_POST['motivo']);
$hora = addslashes($_POST['hora']);
$status  = "Rejeitado";

	try {

		$sql = "UPDATE movimentoc SET motivo =:motivo, status =:status WHERE lacre =:lacre AND hora =:hora";
		$sql = $pdo->prepare($sql);
		$sql->bindParam(':lacre', $lacre);
		$sql->bindParam(':motivo', $motivo);
		$sql->bindParam(':hora', $hora);
		$sql->bindParam(':status', $status);
		if($sql->execute() >0){
			echo "Malote rejeitado com sucesso!";
			
		}header('Location: ../listar_malotes_cabecalho.php');
		
		
		
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	
}
?>