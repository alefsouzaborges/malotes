<?php
include_once('classes/config-database.php');

$id = $_SESSION['id'];
$idUnidade = $_SESSION['unidade'];
$sql = "SELECT * FROM unidades WHERE id =:id";
$sql = $pdo->prepare($sql);
$sql->bindValue(':id', $idUnidade);
$sql->execute();
$dados = $sql->fetch();


?>
<nav class="navbar navbar-expand-lg navbar-dark bg-color-bg nav-border-shadow-bottom">
	<a class="navbar-brand" href="index.php"><img src="assets/images/logo02.png" width="100"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse justify-content-center text-light" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Dashboard<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown text-light">	
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Cadastros
				</a>
				<div class="dropdown-menu " aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="cadastrar_usuario.php">Usuários</a>
					<a class="dropdown-item" href="cadastrar_unidades.php">Unidades</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="cadastrar_motoristas.php">Motoristas</a>
					<a class="dropdown-item" href="cadastrar_transportes.php">Transportes</a>
					<a class="dropdown-item" href="cadastrar_tipos.php">Tipos</a>
				</div>
			</li>
			<li class="nav-item dropdown text-light">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Operações
				</a>
				<div class="dropdown-menu " aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="itens.php">Lançar Malotes</a>
					<a class="dropdown-item" href="listar_malotes_cabecalho.php">Listar Malotes</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="cadastrar_senha.php">Trocar senha</a>
				</div>
			</li>
			<li class="nav-item dropdown text-light">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Relatórios
				</a>
				<div class="dropdown-menu " aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Usuários</a>
					<a class="dropdown-item" href="#">Unidades</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Motoristas</a>
					<a class="dropdown-item" href="#">Transportes</a>
					<a class="dropdown-item" href="#">Tipos</a>
				</div>
			</li>
			<li class="nav-item dropdown text-light">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Sistema
				</a>
				<div class="dropdown-menu " aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Definir Acessos</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">Sair<span class="sr-only">(current)</span></a>
			</li>
			<p class="mt-0 mb-0">
				<a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
					<img src="assets/icons/person.png" width="18">
				</a>
			</p>
		</ul>
	</div>
</nav>
<div class="collapse" id="collapseExample">
	<div class="card card-body bg-color-bg " style="height: 25px; background-color: rgba(0,0,0,.1);">
		<div class="row">
			<span style="position: relative; bottom: 10px; font-size: 12px;"><?php echo "Usuário:   ".$_SESSION['nome']." | "." E-mail: ".
			$_SESSION['email']." | "."Nivel: ".$_SESSION['nivel']." | ".$_SESSION['unidade']." - ".$dados['razaosocial'];
			?>
		</span>
		
	</div>
</div>
</div>
<!-- Modal sair-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="color: #000">Sair</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="color: #000">
				Tem certeza que deseja sair?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<?php echo '<a class="btn btn-primary" href="classes/deslogar.php?id='.$id.'">Continuar</a>' ?>
					<!--<?php echo '<a href="classes/deslogar.php?id='.$id.'">Continuar</a>' ?>-->
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	MARQUEE{
		color: #fff;
	}
</style>
<?php
if($_SESSION['senha'] == '81dc9bdb52d04dc20036dbd8313ed055'){
		echo "<MARQUEE>Olá, sua senha ainda é a padrão do sistema, por favor realize imediatamente a troca de senha no menu Operações!...</MARQUEE>";
	}else{

}

?>