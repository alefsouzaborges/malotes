<?php
require_once('config-database.php');
if(isset($_POST['tipo']) && !empty($_POST['tipo'])){

	$tipo = addslashes($_POST['tipo']);
	$id = $_GET['id'];

	try {

		$sql = "UPDATE tipos SET tipo =:tipo WHERE id =:id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':tipo', strtoupper($tipo));
		$sql->bindValue(':id', $id);

		if($sql->execute() >0){
			echo "Tipo Alterado com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>