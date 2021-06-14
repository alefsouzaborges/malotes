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
movimentoc.usuario as user,
movimentoc.status as status,
movimentoc.motivo as motivo,
u1.razaosocial AS remetente,
remetente as idremetente,
destinatario as iddestinatario,
u2.razaosocial AS destinatario
FROM movimentoc
LEFT JOIN tipos ON (tipoC = tipos.id)
LEFT JOIN unidades u1 ON (movimentoc.remetente = u1.id)
LEFT JOIN unidades u2 ON (movimentoc.destinatario = u2.id)
LEFT JOIN usuarios user1 ON (movimentoc.usuario = user1.id)
LEFT JOIN motoristas moto ON (movimentoc.motorista = moto.id)
LEFT JOIN transportes transp ON (movimentoc.transporte = transp.id)
WHERE remetente = $unidade_logada or destinatario = $unidade_logada
ORDER BY $ordenar DESC LIMIT $p, $qt_por_pagina";
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
								<option value="transporte">Transporte</option>
								<option value="motorista">Motorista</option>
								<option value="Motivo">Motivo</option>
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
				         }if($dados['status'] == "Rejeitado"){
				         	echo '<span style="color: red;">'.$dados['status'].'</span>';
				         }
				         ?></a></td>
				         <td><?php echo '<span style="color: red; font-size:12px">'.$dados['motivo'].'</span>' ?></td>
				        <td align="center"><a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['datamvto']?></a></td>
				      <td align="center">
				      	<a href="listar_malotes_detalhes.php?lacre=<?php echo $dados['lacre']?>&hora=<?php echo $dados['hora'] ?>"><?php echo $dados['hora']?></a>
				      </td>
				     <td>

						<?php

						if($_SESSION['unidade'] == $dados['idremetente'] || $dados['status'] == "Recebido" || $dados['status'] == "Rejeitado"):
							
						?>
						   
						   	<button type="button" class="btn btn-sm btn-danger" disabled=""><a href="javascript:;" style="color: #fff">Receber</a></button></td>

						<?php
						else:
						?>
							<button type="button" class="btn btn-sm btn-primary" ><a href="classes/acao_malote_receber.php?lacre=<?php echo $dados['lacre'] ?>&hora=<?php echo $dados['hora']; ?>" style="color: #fff">Receber</a></button></td>

						<?php
				
							
						endif;	
						?>


				    <td>

				    	<?php

						if($_SESSION['unidade'] == $dados['idremetente'] || $dados['status'] == "Recebido" || $dados['status'] == "Rejeitado"):

						?>
						   	 <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="modal" data-target="" data-whatever="<?php echo $dados['lacre']; ?>" data-whatever2="<?php echo $dados['hora']; ?>" ><a href="javascript:;" style="color: #fff">Rejeitar</a></button>
						<?php
						else:

						?>
						    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal1" data-whatever="<?php echo $dados['lacre']; ?>" data-whatever2="<?php echo $dados['hora']; ?>" ><a href="javascript:;" style="color: #fff">Rejeitar</a></button>
						   
						<?php
						endif;	
						?>

				    </td>
				    </tr>
				  	<?php endforeach; ?>
				  </tbody>
				</table>
			<div class="row justify-content-center">

				<nav aria-label="Navegação de página exemplo">
					<ul class="pagination">
						
						<?php 

						if($sql->rowCount() >0){
							for ($i=0; $i <=$paginas ; $i++){
							echo '<li class="page-item"><a href="?p='.($i+1).'" class="page-link">['.($i+1).']</a></li>';	
							}
						}else{
							for ($i=0; $i <=$paginas ; $i++){
							echo '<div><li class="page-item"><a href="?p='.($i+1).'" class="page-link">['.($i+1).']</a></li></div>';	
							}
							echo "<div><span style='color:red;font-size:18px;font'>Não há nenhum malote cadastrado.</span></div>";
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
	
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="classes/acao_malote_rejeitar.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Malote</label>
            <div class="container">
		  <div class="row">
			    <div class="col-sm">
			      <input type="text" class="form-control" id="recipient-name1" name="lacre" readonly="">
			    </div>
			    <div class="col-sm">
			     <input type="text" class="form-control" id="recipient-name2" name="hora" readonly="">
			    </div>
			  </div>
		</div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Informe o motivo resumido da rejeição do malote:</label>
            <textarea class="form-control" id="message-text" name="motivo" maxlength="50"></textarea>
          </div>
           <div class="modal-footer">
	        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	        <button type="submit" class="btn btn-primary">Enviar</button>
	      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('#exampleModal1').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever')
  var recipient2 = button.data('whatever2') // Extrai informação dos atributos data-*
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Rejeitar malote')
  modal.find('.modal-body #recipient-name1').val(recipient)
  modal.find('.modal-body #recipient-name2').val(recipient2)
})
</script>
