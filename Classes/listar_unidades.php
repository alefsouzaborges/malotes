<?php
require_once('config-database.php');
if(isset($_POST['codigo']) && !empty($_POST['codigo'])){

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

		$sql = "INSERT INTO unidades SET id =:codigo, cnpj =:cnpj, razaosocial =:razaosocial, uf =:uf,
		cidade =:cidade, endereco =:endereco, numero =:numero";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':codigo', $codigo);
		$sql->bindValue(':cnpj', $cnpj);
		$sql->bindValue(':razaosocial', strtoupper($razaosocial));
		$sql->bindValue(':uf', $uf);
		$sql->bindValue(':cidade', strtoupper($cidade));
		$sql->bindValue(':endereco', $endereco);
		$sql->bindValue(':numero', strtoupper($numero));

		if($sql->execute() >0){
			echo "Unidade Cadastrada com sucesso!";
		}

	}catch (PDOException $e) {
		echo $e->getMessage();

		echo $cnpj;

	}

}


?>