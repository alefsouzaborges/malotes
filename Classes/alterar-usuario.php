<?php
require_once('config-database.php');
if(isset($_POST['nome']) && !empty($_POST['nome'])){

$iduser = $_GET['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$unidade = $_POST['unidade'];

try {

	$consulta = "SELECT * FROM unidades WHERE razaosocial =:unidade";
	$consulta = $pdo->prepare($consulta);
	$consulta->bindPARAM(':unidade', $unidade);
	$consulta->execute();

	if($status == 'Escolher...' || $nivel == 'Escolher...' || $unidade == 'Escolher...'){

	echo "Preencha os campos de selecão!";

	}
	
	else{
		
	if($consulta->rowCount() >0){
	$dados = $consulta->fetch();
		
	$sql = "UPDATE usuarios SET nome =:nome, email = :email, nivel =:nivel, status =:status, unidade =:unidade WHERE id =:id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':nome', strtoupper($nome));
	$sql->bindValue(':email', $email);
	$sql->bindValue(':nivel', $nivel);
	$sql->bindValue(':status', $status);
    $sql->bindValue(':unidade', $dados['id']);
	$sql->bindValue(':id', $iduser);
	
	if($sql->execute() >0){
		echo "Usuário Alterado com sucesso!"."<br>";

	}else{
		echo "nao";
	}

	
}
	}

	}catch (PDOException $e) {
		echo $unidade;
		echo $e->getMessage();		 
	}

}


?>