<?php
require_once('config-database.php');
if(isset($_POST['nome']) && !empty($_POST['nome'])){

$nome = $_POST['nome'];
$email = $_POST['email'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$unidade = $_POST['unidade'];
$senha = '1234';

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
		
	$sql = "INSERT INTO usuarios SET nome =:nome, email = :email, nivel =:nivel, status =:status, unidade =:unidade, senha =:senha";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':nome', strtoupper($nome));
	$sql->bindValue(':email', $email);
	$sql->bindValue(':nivel', $nivel);
	$sql->bindValue(':status', $status);
    $sql->bindValue(':unidade', $dados['id']);
	$sql->bindValue(':senha', md5($senha));
	
	if($sql->execute() >0){
		echo "Usuário Cadastrado com sucesso!"."<br>";
		/////////////////////////////SELECIONANDO O ULTIMO ID INSERIDO PARA INSERIR O MESMO ID NA TABELA DE PERMISSÕES///////////////
		$sqlLastId = "SELECT LAST_INSERT_ID() as ultimo_usuario FROM usuarios";
		$sqlLastId = $pdo->prepare($sqlLastId);
		$sqlLastId->execute();

		$ultimoUsuario = $sqlLastId->fetch();
		///////////////////////////INSERINDO O ULTIMO ID INSERIDO NA TABELA DE PERMISSÕES///////////////////////////////////////////
		$sqlPermissoes = "INSERT INTO permissoes SET prUsuario =:usuario";
		$sqlPermissoes = $pdo->prepare($sqlPermissoes);
		$sqlPermissoes->bindValue(':usuario', $ultimoUsuario['ultimo_usuario']);
		if($sqlPermissoes->execute() >0){
			echo "Libere as permissões de acesso no menu Sistema";
		}	


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