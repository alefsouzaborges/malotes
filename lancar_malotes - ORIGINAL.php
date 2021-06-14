<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];
$unidade_logada = $_SESSION['unidade'];


    $qt_por_pagina = 5;
	$total = 0;

	$sql = "SELECT count(*) as c FROM movimentoc";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$sql = $sql->fetch();
	$total = $sql['c'];
	$paginas = $total / $qt_por_pagina;

		$pg = 1;
	if(isset($_GET['p']) && !empty($_GET['p'])){
		$pg = addslashes($_GET['p']);
	}
	$p = ($pg -1) * $qt_por_pagina;

	$sql = "SELECT * FROM movimentoc LIMIT $p,$qt_por_pagina";
	$sql = $pdo->prepare($sql);
	$sql->execute();

	if(empty($_GET['ordem'])){
		$ordenar = "lacre";
	}else{
		$ordenar = $_GET['ordem'];
	}

$sql = "SELECT 
lacre,
user1.nome as usuario,
tipo,
moto.nome as motorista,
transp.tipo_transporte as transporte,
datamvto,
hora,
movimentoc.status as status,
movimentoc.motivo as motivo,
u1.razaosocial AS remetente,
u2.razaosocial AS destinatario
FROM movimentoc
LEFT JOIN tipos ON (tipoC = tipos.id)
LEFT JOIN unidades u1 ON (movimentoc.remetente = u1.id)
LEFT JOIN unidades u2 ON (movimentoc.destinatario = u2.id)
LEFT JOIN usuarios user1 ON (movimentoc.usuario = user1.id)
LEFT JOIN motoristas moto ON (movimentoc.motorista = moto.id)
LEFT JOIN transportes transp ON (movimentoc.transporte = transp.id)
WHERE remetente = $unidade_logada or destinatario = $unidade_logada
ORDER BY $ordenar LIMIT $p, $qt_por_pagina";
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
	<script type="text/javascript" src="assets/js/script.js"></script>
	<style type="text/css">
		table th a{
			color: #fff;
			font-size: 12px;
		}
		table th a:hover{
			color: #fff;
		}
		span .aguardando{
			color: red;
		}
		table td a{
			font-size: 12px;
		}
	</style>
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-listar-usuarios">
				<table class="table table-sm table-striped table-hover table-light" style="color: #000; border-radius: 5px;" border="0">
					<div class="mb-0" style="margin-right: 0px;">
					<form method="GET">
					<div class="form-row justify-content-end">
						<div class="form-group col-md-3">
							<label for="inputEstado">Ordenado por : <?php echo $ordenar;?></label>
							<select id="inputEstado" class="form-control" name="ordem" onchange="this.form.submit()">
								<option>Escolher...</option>
								<option value="lacre">Lacre</option>
								<option value="usuario">Usuario</option>
								<option value="remetente">Remetente</option>
								<option value="destinatario">Destinatário</option>
								<option value="tipo">Tipo</option>
								<option value="motorista">Motorista</option>
								<option value="transporte">Transporte</option>
								<option value="datamvto">Data</option>
								<option value="hora">Hora</option>				
							</select></div>
					</form>
				</div>
				  <thead>
				    <tr style="background-color: #292d96;height: 30px; text-align: center; color: #fff; line-height: 30px;">
				      <th scope="col"><a href=""><?php echo "Lacre"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Usuário"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Remetente"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Destinatário"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Tipo"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Motorista"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Transporte"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Status"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Motivo"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Data"; ?></a></th>
				      <th scope="col"><a href=""><?php echo "Hora"; ?></a></th>
				      <th scope="col" align="center" colspan="2"><a href="">Ação</th>				   
				    </tr>
				  </thead>
					  	<?php foreach($sql->fetchAll() as $dados):  ?>
					  <tr> 
				        <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora']?>"><?php echo $dados['lacre']?></a></td>
				       <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['usuario']?></a></td>
				      <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['remetente']?></a></td>
				      <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['destinatario']?></a></td>
				      <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['tipo']?></a></td>
				      <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['motorista']?></a></td>
				       <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora']?>"><?php echo $dados['transporte']?></a></td>
				        <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora']?>"><?php  if($dados['status'] == "Aguardando Confirmação"){ 
				        	echo '<span style="color: #ff9900;">'.$dados['status'].'</span>';
				         }if($dados['status'] == "Recebido"){
				         	echo '<span style="color: green;">'.$dados['status'].'</span>';
				         }?></a></td>
				         <td><?php echo $dados['motivo']; ?></td>
				        <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['datamvto']?></a></td>
				      <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['hora']?></a></td>
				     <td><button type="button" class="btn btn-sm btn-primary" ><a href="classes/acao_malote_receber.php?lacre=<?php echo $dados['lacre'] ?>&hora=<?php echo $dados['hora']; ?>" style="color: #fff">Receber</a></button></td>
				    <td>
				    	<button type="button" class="btn btn-sm btn-primary" ><a href="javascript:;" style="color: #fff" onclick="rejeitar('<?php echo $dados['lacre']?>')">Rejeitar</a></button>
				    </td>
				    </tr>
				  	<?php endforeach; ?>
				  </tbody>
				</table>
			<div class="row justify-content-center">

				<nav aria-label="Navegação de página exemplo">
					<ul class="pagination">
						
						<?php 
						for ($i=0; $i <=$paginas ; $i++){
							echo '<li class="page-item"><a href="?p='.($i+1).'" class="page-link">['.($i+1).']</a></li>';						
						}
						?>
					</ul>
				</nav>

			</div>
			</div>
		</div>
	</body>
</body>
</html>
	
	<div id="modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
	<div class="modal-body">
			<div class="modal-header">
	        <h5 class="modal-title" id="TituloModalCentralizado">Motivo</h5>
	    </div>
		<form action="form.php" method="POST">
			<div class="form-group">
			     <label for="message-text" class="col-form-label">Informe o motivo da rejeição do malote</label>
			     <label for="recipient-name" class="col-form-label">Destinatário:</label>
			     <textarea class="form-control" name="motivo" required=""></textarea>
			 </div>
			<div class="modal-footer">
				<a href="teste"><button type="submit" class="btn btn-primary">Gravar</button></a>
			<div>
		</form>
	</div>
		</div>
		</div>		
	</div>

	</div>