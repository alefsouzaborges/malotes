<?php
function gravarAcessos(){
	include_once('config-database.php');
include_once('validar-usuario.php');
include_once('valida-sessao.php');
$id = $_SESSION['id'];

$usuarioId = $_GET['usuarioId'];
$usuario = $_GET['usuario'];



if(isset($_GET['chkCadUsuarios'])){
$cadUsuarios = "S";
}else{
$cadUsuarios = "N"; 
}
if(isset($_GET['checkCadUnidades'])){
$cadUnidades = "S";
}else{
$cadUnidades = "N"; 
}
if(isset($_GET['checkCadMotoristas'])){
$cadMotoristas = "S";
}else{
$cadMotoristas = "N"; 
}
if(isset($_GET['checkCadTransportes'])){
$cadTransportes = "S";
}else{
$cadTransportes = "N"; 
}
if(isset($_GET['checkCadTipos'])){
$cadTipos = "S";
}else{
$cadTipos = "N"; 
}
if(isset($_GET['checkOpLancarMalotes'])){
$opLancarMalotes = "S";
}else{
$opLancarMalotes = "N"; 
}
if(isset($_GET['checkOpListarMalotes'])){
$opListarMalotes = "S";
}else{
$opListarMalotes = "N"; 
}
if(isset($_GET['checkopListarUsuarios'])){
$opListarUsuarios = "S";
}else{
$opListarUsuarios = "N"; 
}
if(isset($_GET['checkopListarUnidades'])){
$opListarUnidades = "S";
}else{
$opListarUnidades = "N"; 
}
if(isset($_GET['checkOpListarMotoristas'])){
$opListarMotoristas = "S";
}else{
$opListarMotoristas = "N"; 
}
if(isset($_GET['checkOpListarTransportes'])){
$opListarTransportes = "S";
}else{
$opListarTransportes = "N"; 
}
if(isset($_GET['checkOpListarTipos'])){
$opListarTipos = "S";
}else{
$opListarTipos = "N"; 
}
if(isset($_GET['checkOpTrocarSenha'])){
$opTrocarSenha = "S";
}else{
$opTrocarSenha = "N"; 
}
if(isset($_GET['checkRelUsuarios'])){
$relUsuarios = "S";
}else{
$relUsuarios = "N"; 
}
if(isset($_GET['checkRelUnidades'])){
$relUnidades = "S";
}else{
$relUnidades = "N"; 
}
if(isset($_GET['checkRelMotoristas'])){
$relMotoristas = "S";
}else{
$relMotoristas = "N"; 
}
if(isset($_GET['checkRelTransportes'])){
$relTransportes = "S";
}else{
$relTransportes = "N"; 
}
if(isset($_GET['checkRelTipos'])){
$relTipos = "S";
}else{
$relTipos = "N"; 
}
if(isset($_GET['checkRelMalotesReijatados'])){
$relMalotesRejeitados = "S";
}else{
$relMalotesRejeitados = "N"; 
}
if(isset($_GET['checkRelMalotesEmEspera'])){
$relmalotesEmEspera = "S";
}else{
$relmalotesEmEspera = "N"; 
}
if(isset($_GET['checkRelMalotesRecebidos'])){
$relMalotesRecebidos = "S";
}else{
$relMalotesRecebidos = "N"; 
}
if(isset($_GET['checkRelMalotes'])){
$relMalotes = "S";
}else{
$relMalotes = "N"; 
}

try {

$sql = "UPDATE permissoes SET cadUsuarios = :cadUsuarios, cadUnidades =:cadUnidades,cadMotoristas = :cadMotoristas, cadTransportes = :cadTransportes, cadTipos = :cadTipos, relUsuarios =:relUsuarios, relUnidades =:relUnidades,relMotoristas = :relMotoristas,relTransportes =:relTransportes,relTipos =:relTipos, relMalotesRejeitados =:relMalotesRejeitados, relmalotesEmEspera =:relmalotesEmEspera, relMalotesRecebidos =:relMalotesRecebidos, relMalotes = :relMalotes, opLancarMalotes =:opLancarMalotes, opListarMalotes =:opListarMalotes, opListarUsuarios =:opListarUsuarios, opListarUnidades =:opListarUnidades, opListarMotoristas =:opListarMotoristas, opListarTransportes =:opListarTransportes, opListarTipos =:opListarTipos, opTrocarSenha =:opTrocarSenha WHERE prUsuario =:id";
$sql = $pdo->prepare($sql);
/////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE CADASTROS//////////////////////////////////////////////
$sql->bindValue(':cadUsuarios', $cadUsuarios);
$sql->bindValue(':cadUnidades', $cadUnidades);
$sql->bindValue(':cadMotoristas', $cadMotoristas);
$sql->bindValue(':cadTransportes', $cadTransportes);
$sql->bindValue(':cadTipos', $cadTipos);
////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE RELATÓRIOS//////////////////////////////////////////////
$sql->bindValue(':relUsuarios', $relUsuarios);
$sql->bindValue(':relUnidades', $relUnidades);
$sql->bindValue(':relMotoristas', $relMotoristas);
$sql->bindValue(':relTransportes', $relTransportes);
$sql->bindValue(':relTipos', $relTipos);
$sql->bindValue(':relMalotesRejeitados', $relMalotesRejeitados);
$sql->bindValue(':relmalotesEmEspera', $relmalotesEmEspera);
$sql->bindValue(':relMalotesRecebidos', $relMalotesRecebidos);
$sql->bindValue(':relMalotes', $relMalotes);
////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE OPERAÇÕES//////////////////////////////////////////////
$sql->bindValue(':opLancarMalotes', $opLancarMalotes);
$sql->bindValue(':opListarMalotes', $opListarMalotes);
$sql->bindValue(':opListarUsuarios', $opListarUsuarios);
$sql->bindValue(':opListarUnidades', $opListarUnidades);
$sql->bindValue(':opListarMotoristas', $opListarMotoristas);
$sql->bindValue(':opListarTransportes', $opListarTransportes);
$sql->bindValue(':opListarTipos', $opListarTipos);
$sql->bindValue(':opTrocarSenha', $opTrocarSenha);
$sql->bindValue(':id', $usuarioId);
if($sql->execute() >0){
	echo "Definições gravadas para o usuário - ".$usuario;
}else{
	echo "Nao";
}



	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/template.css">
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
	<title></title>
	<style type="text/css">
		span,h1,p{
			color: #fff;
		}
		body{
			background-image: url('../assets/images/bg.jpg');
			background-size: cover;
			background-size: cover;
		}
	</style>
</head>
<body class="">
	<div class="container">
		<div class="row justify-content-center" style="position: relative;top: 120px;">
			<div class="jumbotron" style="background-color: rgba(0,0,0,0.1);">
				<div class="row justify-content-center">
					<h1 class="display-4">Menssagem</h1>
				</div>
				<div class="row justify-content-center mb-0">
					<p class="lead"><?php gravarAcessos();?></p>
				</div>
				<hr class="my-4">
				<div class="row justify-content-center"> 
					<!--<p>Verique se existe o cadastro de todos os campos corretamente!.></p>-->
				</div>
				<div class="row justify-content-center">
					<a class="btn btn-primary btn-lg" href="../definir_acessos_usuario.php" role="button">Voltar</a>
				</div>
			</div>
		</div>
	</div>

</body>
</html>