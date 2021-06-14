<?php
function inserirMalote(){
	require_once('config-database.php');
	include_once('validar-usuario.php');
	date_default_timezone_set('America/Sao_Paulo');
	if(isset($_POST['lacre']) && !empty($_POST['lacre'])){
//==========================Cabeçalho====================//
		$lacre = $_POST['lacre'];
		$remetente = $_SESSION['unidade'];
		$destinatario = $_POST['destinatario'];
		$tipo = $_POST['tipo'];
		$usuario = $_SESSION['id'];
		$motorista = $_POST['motorista'];
		$transporte = $_POST['transporte'];
		$hora = date('h:i:s');
//================================================Itens========================================================//
		$remetente_usuario = $_POST['remetente-usuario'];
		$destinatario_usuario = $_POST['destinatario-usuario'];
		$tipo_encomenda = $_POST['tipo-encomenda'];
		$qtde = $_POST['total'];
		$observacao = $_POST['obs'];
//==================================CONVERTERNDO NOMES PARA ID================================================//
//==============================SELECIONANDO O ID DA RAZAO SOCIAL=============================================//
		$sqlD = "SELECT id FROM unidades WHERE razaosocial =:razaosocial";
		$sqlD = $pdo->prepare($sqlD);
		$sqlD->bindParam(':razaosocial',$destinatario);
		$sqlD->execute();
		$idRazaoDest = $sqlD->fetchColumn();
//==============================SELECIONANDO O ID DO TIPO CABEÇALHO=============================================//
		$sqlTc = "SELECT id FROM tipos WHERE tipo =:tipo";
		$sqlTc = $pdo->prepare($sqlTc);
		$sqlTc->bindParam(':tipo',$tipo);
		$sqlTc->execute();
		$sqlTc = $sqlTc->fetchColumn();
//==============================SELECIONANDO O ID DO MOTORISTA===================================================//
		$sqlM = "SELECT id FROM motoristas WHERE nome =:nome";
		$sqlM = $pdo->prepare($sqlM);
		$sqlM->bindParam(':nome',$motorista);
		$sqlM->execute();
		$sqlM = $sqlM->fetchColumn();
//==============================SELECIONANDO O ID DO TRANSPORTE=================================================//
		$sqlT = "SELECT id FROM transportes WHERE tipo_transporte =:tipo";
		$sqlT = $pdo->prepare($sqlT);
		$sqlT->bindParam(':tipo',$transporte);
		$sqlT->execute();
		$sqlT = $sqlT->fetchColumn();

		try {
			if($destinatario != 'Escolher...' || $motorista != 'Escolher...' || $transporte != 'Escolher...'){

				$sqlc = "INSERT INTO movimentoc SET lacre = :lacre, remetente = :remetente, destinatario =:destinatario, tipoC =:tipo,
				usuario =:usuario, motorista =:motorista, transporte =:transporte, datamvto = NOW(), hora =:hora";
				$sqlc = $pdo->prepare($sqlc);
				$sqlc->bindValue(':lacre', $lacre);
				$sqlc->bindValue(':remetente', $remetente);
				$sqlc->bindValue(':destinatario', $idRazaoDest);
				$sqlc->bindValue(':tipo', $sqlTc);
				$sqlc->bindValue(':usuario', $usuario);
				$sqlc->bindValue(':motorista', $sqlM);
				$sqlc->bindValue(':transporte', $sqlT);
				$sqlc->bindValue(':hora', $hora);
				if($sqlc->execute()>0){
					echo "Malote cadastrado com sucesso!";
				};

				$total = count($remetente_usuario)-1;
				for ($i=0; $i <=$total ; $i++) { 

					$sqlRu = "SELECT id FROM usuarios WHERE nome =:remetenteUsuario";
					$sqlRu = $pdo->prepare($sqlRu);
					$sqlRu->bindParam(':remetenteUsuario', $remetente_usuario[$i]);
					$sqlRu->execute();
					$sqlRu = $sqlRu->fetchColumn();	

					$sqlDu = "SELECT id FROM usuarios WHERE nome =:destinatarioUsuario";
					$sqlDu = $pdo->prepare($sqlDu);
					$sqlDu->bindParam(':destinatarioUsuario', $destinatario_usuario[$i]);
					$sqlDu->execute();
					$sqlDu = $sqlDu->fetchColumn();	

					$sqlTd = "SELECT id FROM tipos WHERE tipo =:tipo";
					$sqlTd = $pdo->prepare($sqlTd);
					$sqlTd->bindParam(':tipo', $tipo_encomenda[$i]);
					$sqlTd->execute();
					$sqlTd = $sqlTd->fetchColumn();	

					$sqld = "INSERT INTO movimentod SET lacre =:lacre,remetente =:remetente, destinatario =:destinatario,
					tipoD =:tipo, qtde =:qtde, observacao =:obs,unid_dest =:unid_dest, datamvto = NOW(), horaD =:hora";
					$sqld = $pdo->prepare($sqld);
					$sqld->bindValue(':lacre', $lacre);
					$sqld->bindValue(':remetente', $sqlRu);
					$sqld->bindValue(':destinatario', $sqlDu);
					$sqld->bindValue(':unid_dest', $idRazaoDest);
					$sqld->bindValue(':tipo', $sqlTd);
					$sqld->bindValue(':qtde', $qtde[$i]);
					$sqld->bindValue(':hora', $hora);
					$sqld->bindValue(':obs', $observacao[$i]);
					$sqld->execute();	

				}

			}else{
				echo '<span style="color: red;">Preencha corretamente os campos de seleção!</span>';
			}
		} catch (PDOException $e) {
			echo "<span>".$e->getMessage()."</span>";

		}

	}
}

//echo '<span style="color: red;">Preencha corretamente os campos de seleção!</span>';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/template.css">
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
	<title></title>
	<style type="text/css">
		span,h1,p{
			color: #fff;
		}
		body{
			background-image: url('../assets/images/bg.jpg');
			background-size: cover;
			background-size: cover;
		}
	</style>
</head>
<body class="">
	<div class="container">
		<div class="row justify-content-center" style="position: relative;top: 120px;">
			<div class="jumbotron" style="background-color: rgba(0,0,0,0.1);">
				<div class="row justify-content-center">
					<h1 class="display-4">Menssagem</h1>
				</div>
				<div class="row justify-content-center mb-0">
					<p class="lead"><?php inserirMalote();?></p>
				</div>
				<hr class="my-4">
				<div class="row justify-content-center"> 
					<!--<p>Verique se existe o cadastro de todos os campos corretamente!.></p>-->
				</div>
				<div class="row justify-content-center">
					<a class="btn btn-primary btn-lg" href="../itens.php" role="button">Voltar</a>
				</div>
			</div>
		</div>
	</div>

</body>
</html>