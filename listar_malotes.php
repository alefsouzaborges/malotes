<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];

$sql = " SELECT  remetente, lacre, destinatario,tipo,qtde,observacao,datamvto,u1.nome AS remetente, 
u2.nome AS destinatario FROM movimentod LEFT JOIN usuarios u1 ON (movimentod.remetente = u1.id)
 LEFT JOIN usuarios u2 ON (movimentod.destinatario = u2.id) ORDER BY lacre DESC	";
$sql = $pdo->prepare($sql);
$sql->execute();
number_format(1, 2, '.', '');
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
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($sql->fetchAll() as $dados):  ?>
					  <tr>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['lacre']?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['remetente']?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['destinatario']?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['tipo']?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo number_format($dados['qtde'],2,'.','')?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['observacao']?></a></td>
				      <td><a href="<?php echo $dados['lacre'] ?>"><?php echo $dados['datamvto']?></a></td>
				    </tr>
				  	<?php endforeach; ?>
				  </tbody>
				</table>


			</div>
		</div>
	</body>
</body>
</html>
