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
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-cad-usuarios">
				<div class="row justify-content-center text-cadastrar">
					CADASTRAR SENHA
				</div>
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">SENHA</label>
							<input type="password" class="form-control" id="inputEmail4" placeholder="Senha" name="senha" required="" autocomplete="off" minlength="6">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">REPETIR SENHA</label>
							<input type="password" class="form-control" id="inputEmail4" placeholder="Repetir Senha" name="rsenha" required="" autocomplete="off" minlength="6">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
						<span style="color: red; font-weight: 600;"><?php  include_once('classes/cadastrar-senha.php');?></span>
					</form>
				</div>
			</div>
		</div>
	</body>
</body>
</html>
