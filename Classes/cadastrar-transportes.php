<?php
require_once('config-database.php');
if(isset($_POST['tipo']) && !empty($_POST['tipo'])){

	$tipo = addslashes($_POST['tipo']);


	try {

		$sql = "INSERT INTO transportes SET tipo_transporte =:tipo";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':tipo', strtoupper($tipo));

		if($sql->execute() >0){
			echo "Transporte Cadastrado com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>