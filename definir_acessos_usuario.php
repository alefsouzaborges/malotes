<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];

$sqlUsuarios = "SELECT * FROM Usuarios";
$sqlUsuarios = $pdo->prepare($sqlUsuarios);
$sqlUsuarios->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Definir Acessos Usuários</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/template.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.mask.min.js"></script>
</head>
<body class="bg-body-image">
<div class="container-fluid">
    <div class="row justify_row justify-content-center">
        <div class="box-form-cad-usuarios">
            <div class="row justify-content-center text-cadastrar">
                DEFINIR ACESSOS
            </div>
            <form style="border: 1px solid #ccc;padding: 20px;" method="POST" action="definir_acessos.php">
                <div class="form-row">
                    <div class="form-group col">
                    <label for="inputEmail4">Selecione um usuário para definir as permissões.</label>
                    <select class="form-control form-control-sm" name="usuario">
						<?php foreach($sqlUsuarios as $usuarios): ?>

						<option><?php echo $usuarios['nome'] ?></option>

						<?php endforeach; ?>
					</select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Avançar</button>
                    <span style="color: red; font-weight: 600;"><?php include_once('classes/cadastrar-motoristas.php'); ?></span>
            </form>
        </div>
    </div>
</div>
</body>
</div>
</html>