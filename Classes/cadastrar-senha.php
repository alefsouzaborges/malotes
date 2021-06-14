<?php
require_once('config-database.php');
if(isset($_POST['senha']) && !empty($_POST['senha'])){

	$senha = addslashes(md5($_POST['senha']));
	$rsenha = addslashes(md5($_POST['rsenha']));
	$id = $_SESSION['id'];

	try {

		if($senha == $rsenha){

			$sql = "UPDATE usuarios SET senha =:senha WHERE id = $id";
			$sql = $pdo->prepare($sql);
			$sql->bindVALUE(':senha', $senha);
			if($sql->execute()>0){
				echo "Senha atualizada com sucesso!";
			}


		}else{
			echo "As senhas não coencidem!";
		}
		

	}catch (PDOException $e) {
		echo $e->getMessage();		 
	}

}


?>