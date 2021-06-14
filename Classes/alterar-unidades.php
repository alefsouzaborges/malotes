<?php
require_once('config-database.php');
if(isset($_POST['codigo']) && !empty($_POST['codigo'])){


	$idunidade = $_GET['id'];
	$codigo = addslashes($_POST['codigo']);
	$cnpj = addslashes($_POST['cnpj']);
	$razaosocial = addslashes($_POST['razaosocial']);
	$uf = addslashes($_POST['uf']);
	$cidade = addslashes($_POST['cidade']);
	$endereco = addslashes($_POST['endereco']);
	$numero = addslashes($_POST['numero']);
	$cnpj = str_replace('.','', addslashes($cnpj));
	$cnpj = str_replace('-','', addslashes($cnpj));
	$cnpj = str_replace('/','', addslashes($cnpj));

	try {

		$sql = "UPDATE unidades SET cnpj =:cnpj, razaosocial =:razaosocial, uf =:uf,
		cidade =:cidade, endereco =:endereco, numero =:numero WHERE id =:id";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':cnpj', $cnpj);
		$sql->bindValue(':razaosocial', strtoupper($razaosocial));
		$sql->bindValue(':uf', $uf);
		$sql->bindValue(':cidade', strtoupper($cidade));
		$sql->bindValue(':endereco', $endereco);
		$sql->bindValue(':numero', strtoupper($numero));
		$sql->bindValue(':id', $idunidade);

		if($sql->execute() >0){
			echo "Unidade Alterada com sucesso!";	
		}

	}catch (PDOException $e) {
		echo $e->getMessage();

		

	}

}


?>