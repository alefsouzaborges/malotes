<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];
$lacre = addslashes($_GET['lacre']);
$hora = addslashes($_GET['hora']);
$sql = "  SELECT  
 lacre, 
 tipo,
 qtde,
 observacao,
 datamvto,
 horaD,
 u1.nome AS remetente, 
 u2.nome AS destinatario
 FROM movimentod 
 LEFT JOIN usuarios u1 ON (movimentod.remetente = u1.id)
 LEFT JOIN usuarios u2 ON (movimentod.destinatario = u2.id) 
 LEFT JOIN tipos ON (tipoD = tipos.id) 
 WHERE lacre = $lacre AND horaD = :hora;
 ORDER BY lacre DESC";
$sql = $pdo->prepare($sql);
$sql->bindParam('hora', $hora);
$sql->execute();
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
		table th {
			color: #fff;
			font-size: 12px;
		}
		table th:hover{
			color: #fff;
		}
		.aguardando{
			color: red;
		}
		table td a{
			font-size: 12px;
		}
	</style>
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-listar-usuarios">

				<table class="table table-sm table-striped table-hover table-light " style="color: #000; border-radius: 5px;">
				  <thead>
				    <tr style="background-color: #292d96;height: 30px; text-align: center; color: #fff; line-height: 30px;">
				      <th scope="col">Lacre</th>
				      <th scope="col">Remetente</th>
				      <th scope="col">Destinatário</th>
				      <th scope="col">Tipo</th>
				      <th scope="col">Qtde</th>
				      <th scope="col">Obs</th>
				      <th scope="col">Data</th>
				      <th scope="col">Hora</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($sql->fetchAll() as $dados):  ?>
					  <tr>
				     <tr>
				      <td align="center"><a  href="#"><?php echo $dados['lacre']?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['remetente']?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['destinatario']?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['tipo']?></a></td>
				      <td align="center"><a  href="#"><?php echo number_format($dados['qtde'],2,'.','')?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['observacao']?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['datamvto']?></a></td>
				      <td align="center"><a  href="#"><?php echo $dados['horaD']?></a></td>
				    </tr>
				    </tr>
				  	<?php endforeach; ?>
				  </tbody>
				</table>
				<div class="row justify-content-end" style="margin-right: 0px;">
				<a class="btn btn-primary" href="listar_malotes_cabecalho.php">Voltar</a>
			</div>
			</div>
		</div>
	</body>
</body>
</html>
