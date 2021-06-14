<?php
require_once('config-database.php');
if(isset($_POST['tipo']) && !empty($_POST['tipo'])){

	$tipo = addslashes($_POST['tipo']);
	$idTransporte = $_GET['id'];


	try {

		$sql = "UPDATE  transportes SET tipo_transporte =:tipo WHERE id =:id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':tipo', strtoupper($tipo));
		$sql->bindValue(':id', $idTransporte);

		if($sql->execute() >0){
			echo "Transporte Alterado com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>