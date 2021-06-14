<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
//include_once('navbar.php');
$id = $_SESSION['id'];

$usuario = $_POST['usuario'];

$sqlUsuario = "SELECT id FROM usuarios WHERE nome =:nome";
$sqlUsuario = $pdo->prepare($sqlUsuario);
$sqlUsuario->bindParam(':nome', $usuario);
$sqlUsuario->execute();

$usuarioId = $sqlUsuario->fetchColumn();

$sql = "SELECT * FROM permissoes WHERE prUsuario= :id";
$sql = $pdo->prepare($sql);
$sql->bindParam(':id', $usuarioId);
$sql->execute();

echo $usuarioId;

foreach ($sql as $dados) {

	////////////////LIBERAÇÃO CADASTRO////////////////////
	$prCadUsuario = $dados['cadUsuarios'];
	$prCadUnidades = $dados['cadUnidades'];
	$prCadMotoristas = $dados['cadMotoristas'];
	$prCadTransportes = $dados['cadTransportes'];
	$prCadTipos = $dados['cadTipos'];
	////////////////LIBERAÇÃO OPERAÇÕES////////////////////
	$prOpLancarMalotes = $dados['opLancarMalotes'];
	$prOpListarMalotes = $dados['opListarMalotes'];
	$prOpListarUsuarios = $dados['opListarUsuarios'];
	$prOpListarUnidades = $dados['opListarUnidades'];
	$prOpListarMotoristas = $dados['opListarMotoristas'];
	$prOpListarTransportes = $dados['opListarTransportes'];
	$prOpListarTipos = $dados['opListarTipos'];
	$prOpTrocarSenha = $dados['opTrocarSenha'];
	////////////////LIBERAÇÃO RELATÒRIOS////////////////////
	$relUsuarios = $dados['relUsuarios'];
	$relUnidades = $dados['relUnidades'];
	$relMotoristas = $dados['relMotoristas'];
	$relTransportes = $dados['relTransportes'];
	$relTipos = $dados['relTipos'];
	$relMalotesRejeitados = $dados['relMalotesRejeitados'];
	$relMalotesEmEspera = $dados['relMalotesEmEspera'];
	$relMalotesRecebidos = $dados['relMalotesRecebidos'];
	$relMalotes = $dados['relMalotes'];

}
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
	<style type="text/css">
		input{
			cursor: pointer;
		}
	</style>
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-cad-usuarios" style="width: 1200px;">
				<div class="row justify-content-center text-cadastrar">
					DEFINIR ACESSOS
				</div>
				<div class="container">
					<div class="row justify-content-center">
				    		<label><?php echo $usuarioId." - ".$usuario ?></label>
				    	</div>
				  <div class="row ml-1">
				    <div class="col-sm">
				    	<form method="GET" action="classes/definir-acessos.php" value="">
				      <label>Cadastros</label>
				      <hr>
				      <?php if($prCadUsuario == 'S'){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="S" id="defaultCheck1" name="chkCadUsuarios" checked="">
						  <label class="form-check-label" for="defaultCheck1">
						    Usuarios
						  </label>
				      </div>
					';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="N" id="defaultCheck1" name="chkCadUsuarios">
						  <label class="form-check-label" for="defaultCheck1">
						    Usuarios
						  </label>
				      </div>
					';} 
					if($prCadUnidades == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkCadUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Unidades
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkCadUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Unidades
						  </label>
				      </div>';}
				      if($prCadMotoristas == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkCadMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Motoristas
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkCadMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Motoristas
						  </label>
				      </div>';}
				      if($prCadTransportes == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkCadTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Transportes
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkCadTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Transportes
						  </label>
				      </div>';}
				      if($prCadTipos == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkCadTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Tipos
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkCadTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Tipos
						  </label>
				      </div>';}
					?>				      
				    </div>
				    <div class="col-sm">
				    <label>Operações</label>
				    <hr>
				    <?php  
					if($prOpLancarMalotes == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkOpLancarMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Lançar Malotes
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpLancarMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Lançar Malotes
						  </label>
				      </div>';}
					if($prOpListarMalotes == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkOpListarMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Malotes
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpListarMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Malotes
						  </label>
				      </div>';}
				      if($prOpListarUsuarios == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkopListarUsuarios">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Usuários
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkopListarUsuarios">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Usuários
						  </label>
				      </div>';}
				      if($prOpListarUnidades == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkopListarUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Unidades
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkopListarUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Unidades
						  </label>
				      </div>';}
				      if($prOpListarMotoristas == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkOpListarMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Motoristas
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpListarMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Motoristas
						  </label>
				      </div>';}
				      if($prOpListarTransportes == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkOpListarTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Transportes
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpListarTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Transportes
						  </label>
				      </div>';}
				      if($prOpListarTipos == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkOpListarTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Tipos
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpListarTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Listar Tipos
						  </label>
				      </div>';}
				       if($prOpTrocarSenha == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkOpTrocarSenha">
						  <label class="form-check-label" for="defaultCheck1">
						    Trocar Senha
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkOpTrocarSenha">
						  <label class="form-check-label" for="defaultCheck1">
						    Trocar Senha
						  </label>
				      </div>';}
					?>
				    </div>
				    <div class="col-sm">
				     <label>Relatórios</label>
				     <hr>
				     <?php 

				     if($relUsuarios == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkRelUsuarios"
						  <label class="form-check-label" for="defaultCheck1">
						    Usuários
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelUsuarios">
						  <label class="form-check-label" for="defaultCheck1">
						    Usuários
						  </label>
				      </div>';}
				      if($relUnidades == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkRelUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Unidades
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelUnidades">
						  <label class="form-check-label" for="defaultCheck1">
						    Unidades
						  </label>
				      </div>';}
				      if($relMotoristas == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Motoristas
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelMotoristas">
						  <label class="form-check-label" for="defaultCheck1">
						    Motoristas
						  </label>
				      </div>';}
				      if($relTransportes == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Transportes
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelTransportes">
						  <label class="form-check-label" for="defaultCheck1">
						    Transportes
						  </label>
				      </div>';}
				      if($relTipos == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked="" name="checkRelTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Tipos
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelTipos">
						  <label class="form-check-label" for="defaultCheck1">
						    Tipos
						  </label>
				      </div>';}
				      if($relMalotesRejeitados == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelMalotesReijatados">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes rejeitados
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelMalotesReijatados">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes rejeitados
						  </label>
				      </div>';}
				      if($relMalotesEmEspera == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelMalotesEmEspera">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes em espera
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelMalotesEmEspera">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes em espera
						  </label>
				      </div>';}
				      if($relMalotesRecebidos == "S"){echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelMalotesRecebidos">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes recebidos
						  </label>
				      </div>';}else{echo ' <div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelMalotesRecebidos">
						  <label class="form-check-label" for="defaultCheck1">
						    Malotes recebidos
						  </label>
				      </div>';}
				      if($relMalotes == "S"){echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked name="checkRelMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Relatório de Malotes
						  </label>
				      </div>';}else{echo '<div>
				      	<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="checkRelMalotes">
						  <label class="form-check-label" for="defaultCheck1">
						    Relatório de Malotes
						  </label>
				      </div>';}

				     ?>				     	
				    </div>
				  </div>
				  <input type="hidden" name="usuarioId" value="<?php echo $usuarioId; ?>">
				  <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
				  <button class="btn btn-primary btn-block mt-3 mb-1">Gravar</button>
				  <a class="btn btn-primary btn-block" href="definir_acessos_usuario.php">Voltar</a>
				</div>
				</form>

				</div>
			</div>
		</div>
	</body>
</body>
</html>


<?php


?>