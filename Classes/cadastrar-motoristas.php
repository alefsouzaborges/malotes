<?php
require_once('config-database.php');
if(isset($_POST['nome']) && !empty($_POST['nome'])){

	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);


	try {

		$sql = "INSERT INTO motoristas SET nome =:nome, telefone =:telefone";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':nome', strtoupper($nome));
		$sql->bindValue(':telefone', $telefone);

		if($sql->execute() >0){
			echo "Motorista Cadastrado com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>