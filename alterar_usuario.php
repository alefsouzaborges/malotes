	<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
//include_once('navbar.php');
$id = $_GET['id'];


$sql = "SELECT * FROM unidades";
$sql = $pdo->prepare($sql);
$sql->execute();

$sqlUser = "SELECT * FROM usuarios LEFT JOIN unidades ON (usuarios.unidade = unidades.id) WHERE usuarios.id = :id";
$sqlUser = $pdo->prepare($sqlUser);
$sqlUser->bindValue(':id', $id);
$sqlUser->execute();

$nomeuser = $sqlUser->fetch();


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
					ALTERAR USUÁRIOS
				</div>
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nome</label>
							<input type="text" class="form-control" id="inputEmail4" placeholder="Nome" name="nome" required="" autocomplete="off" value="<?php echo $nomeuser['nome'] ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Email</label>
							<input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required="" autocomplete="off" value="<?php echo $nomeuser['email'] ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nivel de Usuário</label>
							<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="position: relative; bottom: 3px;" name="nivel">
								<option selected><?php echo $nomeuser['nivel'];?></option>
								<option>Usuário</option>
								<option>Administrador</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="inputEstado">Status</label>
							<select id="inputEstado" class="form-control" name="status">
								<option selected><?php echo $nomeuser['status'];?></option>
								<option>Ativo</option>
								<option>Inativo</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="inputEstado"><?php echo $nomeuser['nivel'];?></label>
							<select id="inputEstado" class="form-control" name="unidade">
								<option selected><?php echo $nomeuser['razaosocial'];?></option>

								<?php foreach($sql->fetchAll() as $dados):  ?>

								<option><?php echo $dados['razaosocial'];?></option>

							    <?php endforeach; ?>
							</select>
						</div>
						<a href="classes/alterar-usuario.php?iduser=<?php echo $id?>"></a>
						<button type="submit" class="btn btn-primary btn-block">Alterar</button>
						<a href="listar_usuarios.php" class="btn btn-primary mt-1 btn-block">Voltar</a>
						<span style="color: red; font-weight: 600;"><?php  include_once('classes/alterar-usuario.php');?></span>
					</form>
				</div>
			</div>
		</div>
	</body>
</body>
</html>
