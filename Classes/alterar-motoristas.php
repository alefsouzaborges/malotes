<?php
require_once('config-database.php');
if(isset($_POST['nome']) && !empty($_POST['nome'])){

	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);
	$idMotorista = $_GET['id'];


	try {

		$sql = "UPDATE motoristas SET nome =:nome, telefone =:telefone WHERE id =:id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':nome', strtoupper($nome));
		$sql->bindValue(':telefone', $telefone);
		$sql->bindValue(':id', $idMotorista);

		if($sql->execute() >0){
			echo "Motorista Alterado com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>