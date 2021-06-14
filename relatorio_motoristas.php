<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
include_once('assets/fpdf/fpdf.php');
include_once('classes/config-database.php');

	$sql = "SELECT * FROM motoristas";
	$sql = $pdo->prepare($sql);
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
	<script type="text/javascript" src="assets/js/jquery.mask.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#unidade").mask("000")
			$("#cpf").mask("000.000.000-00")
			$("#cnpj").mask("00.000.000/0000-00")
			$("#telefone01").mask("00000-0000")
			$("#telefone02").mask("0000-0000")
			$("#salario").mask("999.999.990,00", {reverse: true})
			$("#cep").mask("00.000-000")
			$("#dataNascimento").mask("00/00/0000")

			$("#rg").mask("999.999.999-W", {
				translation: {
					'W': {
						pattern: /[X0-9]/
					}
				},
				reverse: true
			})

			var options = {
				translation: {
					'A': {pattern: /[A-Z]/},
					'a': {pattern: /[a-zA-Z]/},
					'S': {pattern: /[a-zA-Z0-9]/},
					'L': {pattern: /[a-z]/},
				}
			}

			$("#placa").mask("AAA-0000", options)

			$("#codigo").mask("AA.LLL.0000", options)

			$("#celular").mask("(00) 0000-00009")

			$("#celular").blur(function(event){
				if ($(this).val().length == 15){
					$("#celular").mask("(00) 00000-0009")
				}else{
					$("#celular").mask("(00) 0000-00009")
				}
			})
		})
	</script>
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-listar-usuarios">	
				<table class="table table-sm table-striped table-hover table-light " style="color: #000; border-radius: 5px;">
				  <thead>
				    <tr style="background-color: #292d96;height: 30px; text-align: center; color: #fff; line-height: 30px;">
				      <th scope="col"width="50">codigo</th>
				      <th scope="col">Nome</th>
				      <th scope="col">Telefone</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($sql->fetchAll() as $dados):  ?>
					  <tr>
				      <td align="center" width="50"><a href=""><?php echo $dados['id']?></a></td>
				      <td align="center"><a href=""><?php echo $dados['nome']?></a></td>
				      <td align="center"><a href=""><?php echo $dados['telefone']?></a></td>
				  	<?php endforeach; ?>
				  </tbody>
				</table>
				<div class="row justify-content-end mr-0">
					<form action="classes/pdf_motoristas.php" target="_blank" method="POST" >
					<div class="row justify-content-center mb-2 mr-0">
					<button class="btn btn-primary">Gerar Relatório</button>
					</div>
					</form>
				</div>
		</body>
	</body>
	</html>
