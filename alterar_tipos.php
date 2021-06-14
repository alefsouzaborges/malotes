<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
//include_once('navbar.php');
$idTipo = $_GET['id'];

	$sql = "SELECT * FROM tipos WHERE id =:id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':id', $idTipo);
	$sql->execute();

	$dados = $sql->fetch();

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
					ALTERAR TIPOS
				</div>
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">TIPO</label>
							<input type="text" class="form-control" id="inputEmail4" placeholder="Tipo" name="tipo" required="" autocomplete="off" value="<?php echo $dados['tipo']?>">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Alterar</button>
						<a href="listar_tipos.php" class="btn btn-primary btn-block">Voltar</a>
						<a type="hidden" href="classes/alterar-tipos.php?id=<?php echo $idTipo ?>"></a>
						<span style="color: red; font-weight: 600;"><?php  include_once('classes/alterar-tipos.php');?></span>
					</form>
				</div>
			</div>
		</div>
	</body>
</body>
</html>
