<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
$id = $_SESSION['id'];
$unidade = $_SESSION['unidade'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/template.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<style type="text/css">
		a{
			text-decoration: none;

		}
	</style>
</head>
<body class="bg-color-bg bg-body-image">

	<?php 
	include_once('navbar.php');
	include_once('classes/config-database.php');

	try {
		
		$sql = "SELECT count(id) as total FROM usuarios WHERE online = 'S'";

		$sql = $pdo->prepare($sql);
		$sql->execute();
		if($sql->rowCount()>0){
			foreach ($sql->fetchAll() as $dados) {
				$dados['total'];
			}
		}

		///////////////////////////////////////MALOTES AGUARDANDO//////////////////////////////////////////////////
		$sqlMalotesAguardando = "SELECT count(*) as total FROM movimentoc  WHERE remetente = $unidade  AND status = 'Aguardando Confirmação' or destinatario = $unidade";
		$sqlMalotesAguardando = $pdo->prepare($sqlMalotesAguardando);
		$sqlMalotesAguardando->execute();
		$dadosMalotesAguardando = $sqlMalotesAguardando->fetch();
		//////////////////////////////////////MALOTES RECEBIDOS//////////////////////////////////////////////////
		$sqlMalotesRecebidos = "SELECT count(*) as total FROM movimentoc  WHERE status = 'Recebido' 
		 AND destinatario = $unidade";
		$sqlMalotesRecebidos = $pdo->prepare($sqlMalotesRecebidos);
		$sqlMalotesRecebidos->execute();
		$dadosMalotesRecebidos = $sqlMalotesRecebidos->fetch();
		//////////////////////////////////////MALOTES REJEITADOS////////////////////////////////////////////////
		$sqlMalotesRejeitados = "SELECT count(*) as total FROM movimentoc  WHERE status = 'Rejeitado' 
		 AND remetente = $unidade";
		$sqlMalotesRejeitados = $pdo->prepare($sqlMalotesRejeitados);
		$sqlMalotesRejeitados->execute();
		$dadosMalotesRejeitados = $sqlMalotesRejeitados->fetch();

	} catch (PDOException $e) {
		$e->getMessage();
	}

	?> 

	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-xg-1 mr-1 mb-1">
				<a href="classes/pdf_malotes_em_espera.php" target="_blank" style="text-decoration: none"><div type="text" class="badge-primary card-dash ">
					<h1 align="center">Usuários</h1>
					<h1 class="badge badge-light" style="font-size: 22px; position: relative; left: 85px; top: 10px;"><?php echo $dados['total'] ?></h1>
				</div></a>
			</div>
			<div class="col-xg-1 mr-1 mb-1">
				<a href="classes/pdf_malotes_em_espera.php" target="_blank" style="text-decoration: none"><div type="text" class="badge-primary card-dash ">
					<h1 align="center" style="font-size: 18px">Malotes Aguardando</h1>
					<h1 class="badge badge-light" style="font-size: 22px; position: relative; left: 85px; top: 10px;"><?php echo $dadosMalotesAguardando['total'] ?></h1>
				</div></a>
			</div>
			<div class="col-xg-1 mr-1 mb-1">
				<a href="classes/pdf_malotes_recebidos.php" target="_blank" style="text-decoration: none"><div type="text" class="badge-primary card-dash ">
					<h1 align="center" style="font-size: 18px">Malotes Recebidos</h1>
					<h1 class="badge badge-light" style="font-size: 22px; position: relative; left: 85px; top: 10px;"><?php echo $dadosMalotesRecebidos['total'] ?></h1>
				</div></a>
			</div>
			<div class="col-xg-1 mr-1 mb-1">
				<a href="classes/pdf_malotes_rejeitados.php" target="_blank" style="text-decoration: none"><div type="text" class="badge-primary card-dash ">
					<h1 align="center" style="font-size: 18px">Malotes Rejeitados</h1>
					<h1 class="badge badge-light" style="font-size: 22px; position: relative; left: 85px; top: 10px;"><?php echo $dadosMalotesRejeitados['total'] ?></h1>
				</div></a>
			</div>
		</div>
	</div>

</body>
</html>
