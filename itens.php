<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];


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
			$("#qtde").mask("00")
			$("#unidade").mask("000")
			$("#cpf").mask("000.000.000-00")
			$("#cnpj").mask("00.000.000/0000-00")
			$("#telefone01").mask("00000-0000")
			$("#telefone02").mask("0000-0000")
			$("#salario").mask("999.999.990,00", {reverse: true})
			$("#cep").mask("00.000-000")
			$("#dataNascimento").mask("00/00/0000")

			$("#rg").mask("999.999.999-W" {
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
		<div class="row justify_row justify-content-center" >
			<div class="box-form-lancar-malote">
				<div class="row justify-content-center text-cadastrar">
					Itens
				</div>
<!--=============================================CABEÇALHO=================================================-->
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST" action="lancar_malotes.php">
					<div class="form-row justify-content-center">
						
						<div class="form-group col-md-3">
							<label for="inputEmail4">Qtde</label>
							<input type="number" class="form-control" id="qtde" placeholder="Qtde Itens" name="qtde" required="" autocomplete="off" max="15" min="0" value="1" required="">
						</div>
						<div class="form-group col-md-2">
							<label for="inputEstado">Objetos</label>
							<button type="submit" class="btn btn-primary btn-block">Adicionar</button>
						</div>					
					</form>
				</div>
<!--=============================================ITENS=================================================-->
				</div>
			</div>
		</body>
	</body>
	</html>


