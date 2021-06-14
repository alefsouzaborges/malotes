	<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];

$sql = "SELECT * FROM unidades";
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
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-cad-usuarios">
				<div class="row justify-content-center text-cadastrar">
					CADASTRAR USUÁRIOS
				</div>
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nome</label>
							<input type="text" class="form-control" id="inputEmail4" placeholder="Nome" name="nome" required="" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Email</label>
							<input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required="" autocomplete="off">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nivel de Usuário</label>
							<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="position: relative; bottom: 3px;" name="nivel">
								<option selected>Escolher...</option>
								<option>Usuário</option>
								<option>Administrador</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="inputEstado">Status</label>
							<select id="inputEstado" class="form-control" name="status">
								<option selected>Escolher...</option>
								<option>Ativo</option>
								<option>Inativo</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="inputEstado">Unidade</label>
							<select id="inputEstado" class="form-control" name="unidade">
								<option selected>Escolher...</option>

								<?php foreach($sql->fetchAll() as $dados):  ?>

								<option><?php echo $dados['razaosocial'];?></option>

							    <?php endforeach; ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
						<span style="color: red; font-weight: 600;"><?php  include_once('classes/cadastrar-usuario.php');?></span>
					</form>
				</div>
			</div>
		</div>
	</body>
</body>
</html>
