<?php
session_start();
include_once('config-database.php');
if(isset($_POST['email']) && isset($_POST['senha'])){
	$email = addslashes($_POST['email']);
	$senha = addslashes(md5($_POST['senha']));
	try {

		//////////////////////////////////////////////////////////SELECIONANDO O USUARIO//////////////////////////////////////////////////////////
		$sql = "SELECT id,nome,email,nivel,lpad(unidade,3,'0')as unidade,senha,online,status FROM usuarios WHERE email = :email AND senha = :senha";
		$sql = $pdo->prepare($sql);
		$sql->bindParam(':email', $email);
		$sql->bindParam(':senha', $senha);
		$sql->execute();

		if($sql->rowCount() >0){

			$usuario = $sql->fetch();	

			if($usuario['status'] == 'Ativo'){

			$_SESSION['id'] = $usuario['id'];
			$_SESSION['nome'] = $usuario['nome'];
			$_SESSION['email'] = $usuario['email'];
			$_SESSION['nivel'] = $usuario['nivel'];
			$_SESSION['unidade'] = $usuario['unidade'];
			$_SESSION['senha'] = $usuario['senha'];
			$id = $_SESSION['id'];

			$sql = "UPDATE usuarios SET online = 'S' WHERE id =$id";
			$sql = $pdo->prepare($sql);
			$sql->execute();
			///////////////////////////////////SELECIONANDO A TABELA DE PERMISSAO DO USUARIO QUE FEZ O LOGIN///////////////////////////////////
			$sqlPermissoes = "SELECT * FROM permissoes WHERE prUsuario =:id";
			$sqlPermissoes = $pdo->prepare($sqlPermissoes);
			$sqlPermissoes->bindValue('id', $usuario['id']);
			$sqlPermissoes->execute();
			/////////////////////////////////CRIANDO AS SESSÕES DAS PERMISSÕES DOS USUARIOS///////////////////////////////////////////////////
			foreach ($sqlPermissoes as $dados) {
			$_SESSION['cadUsuario'] = $dados['cadUsuarios'];
			$_SESSION['cadUnidade'] = $dados['cadUnidades'];
			$_SESSION['cadMotorista'] = $dados['cadMotoristas'];
			$_SESSION['cadTransporte'] = $dados['cadTransportes'];
			$_SESSION['cadTipo'] = $dados['cadTipos'];
			$_SESSION['relUsuario'] = $dados['relUsuarios'];
			$_SESSION['relUnidade'] = $dados['relUnidades'];
			$_SESSION['relMotorista'] = $dados['relMotoristas'];
			$_SESSION['relTransporte'] = $dados['relTransportes'];
			$_SESSION['relTipo'] = $dados['relTipos'];
			$_SESSION['relMalotesRejeitados'] = $dados['relMalotesRejeitados'];
			$_SESSION['relMalotesEmEspera'] = $dados['relMalotesEmEspera'];
			$_SESSION['relMalotesRecebidos'] = $dados['relMalotesRecebidos'];
			$_SESSION['relMalotes'] = $dados['relMalotes'];
			$_SESSION['opLancarMalote'] = $dados['opLancarMalotes'];
			$_SESSION['opListarMalote'] = $dados['opListarMalotes'];
			$_SESSION['opListarUsuarios'] = $dados['opListarUsuarios'];
			$_SESSION['opListarUnidades'] = $dados['opListarUnidades'];
			$_SESSION['opListarMotoristas'] = $dados['opListarMotoristas'];
			$_SESSION['opListarTransportes'] = $dados['opListarTransportes'];
			$_SESSION['opListarTipos'] = $dados['opListarTipos'];
			$_SESSION['opTrocarSenha'] = $dados['opTrocarSenha'];
			}

			header('Location: index.php');

			}else{
				echo "Usuário inativo no sistema, Contate o seu superior!...";
			}

		}else{
			echo "Usuário ou senha incorreto!";
			
		}

	} catch (PDOException $e) {

	}


}

?>