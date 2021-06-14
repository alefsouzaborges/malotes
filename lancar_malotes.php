<?php
include_once('classes/validar-usuario.php');
include_once('classes/valida-sessao.php');
include_once('navbar.php');
$id = $_SESSION['id'];

$qtde = $_POST['qtde'];


/////////////////////////////////////////////////SELECINANDO USUARIOS POR NOME/////////////////////////////////////////////



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
			$("#qtde").mask("00")
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
</head>
<body class="bg-body-image">
	<div class="container-fluid">
		<div class="row justify_row justify-content-center" >
			<div class="box-form-lancar-malote">
				<div class="row justify-content-center text-cadastrar">
					Lançar Malotes
				</div>
				<!--=============================================CABEÇALHO=================================================-->
				<form  style="border: 1px solid #ccc;padding: 20px;" method="POST" action="classes/lancar-malotes.php">
					<div class="row justify-content-center">
						<span style="font-size: 18px">Cabeçalho</span>
					</div>
					<div class="form-row justify-content-center">
						<div class="form-group col-md-2">
							<label for="inputEstado">Destinatário</label>
							<select id="inputEstado" class="form-control" name="destinatario">
								<option selected>Escolher...</option>
								<?php 

										$sqlD = "SELECT * FROM unidades";
										$sqlD = $pdo->prepare($sqlD);
										$sqlD->execute();


											foreach($sqlD->fetchAll() as $dados):


											?>

											<option><?php echo $dados['razaosocial']?></option>

											<?php

											endforeach;	
									

									?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="inputEstado">Tipo</label>
							<select id="inputEstado" class="form-control" name="tipo">
								<option selected>Escolher...</option>
								<?php 

										$sqltipoC = "SELECT * FROM tipos";
										$sqltipoC = $pdo->prepare($sqltipoC);
										$sqltipoC->execute();


											foreach($sqltipoC->fetchAll() as $dados):


											?>

											<option><?php echo $dados['tipo']?></option>

											<?php

											endforeach;	
									

									?>			
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="inputEmail4">Lacre</label>
							<input type="text" class="form-control" id="inputEmail4" placeholder="Lacre" name="lacre" autocomplete="off" maxlength="8" required="" minlength="3">
						</div>
						<div class="form-group col-md-2">
							<label for="inputEstado">Motorista</label>
							<select id="inputEstado" class="form-control" name="motorista">
								<option selected>Escolher...</option>
								<?php 

										$sqlMotorista = "SELECT * FROM motoristas";
										$sqlMotorista = $pdo->prepare($sqlMotorista);
										$sqlMotorista->execute();


											foreach($sqlMotorista->fetchAll() as $dados):


											?>

											<option><?php echo $dados['nome']?></option>

											<?php

											endforeach;	
									

									?>			
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="inputEstado">Transporte</label>
							<select id="inputEstado" class="form-control" name="transporte">
								<option selected>Escolher...</option>
								<?php 

										$sqlTransporte = "SELECT * FROM transportes";
										$sqlTransporte = $pdo->prepare($sqlTransporte);
										$sqlTransporte->execute();


											foreach($sqlTransporte->fetchAll() as $dados):


											?>

											<option><?php echo $dados['tipo_transporte']?></option>

											<?php

											endforeach;	
									

									?>		
							</select>
						</div>

						<span style="border: 1px solid #fff; width: 100%"></span>
						
						<!--<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>-->
						<span style="color: red; font-weight: 600;"><?php  //include_once('classes/lancar-malotes.php');?></span>

					</div>
					<!--=============================================ITENS=================================================-->

					<form  style="border: 1px solid #ccc;padding: 20px;" method="POST">
						<div class="row justify-content-center">
							<span style="font-size: 18px">Itens</span>
						</div>
						<div class="form-row">

							<?php
							for ($i=0; $i < $qtde ; $i++) { 

								?>
								<div class="form-group col-md-2">
									<label for="inputEstado">Remetente</label>
									<select id="inputEstado" class="form-control" name="remetente-usuario[]">
										<option selected>Escolher...</option>
										<?php 

										$sqlrU = "SELECT * FROM usuarios WHERE status = 'Ativo'";
										$sqlrU = $pdo->prepare($sqlrU);
										$sqlrU->execute();


											foreach($sqlrU->fetchAll() as $dados):


											?>

											<option><?php echo $dados['nome']?></option>

											<?php

											endforeach;	
									

									?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="inputEstado">Destinatário</label>
									<select id="inputEstado" class="form-control" name="destinatario-usuario[]">
										<option selected>Escolher...</option>
										<?php 

										$sqldU = "SELECT * FROM usuarios WHERE status = 'Ativo'";
										$sqldU = $pdo->prepare($sqldU);
										$sqldU->execute();


											foreach($sqldU->fetchAll() as $dados):


											?>

											<option><?php echo $dados['nome']?></option>

											<?php

											endforeach;	
									

									?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="inputEstado">Tipo</label>
									<select id="inputEstado" class="form-control" name="tipo-encomenda[]">
										<option selected>Escolher...</option>
										<?php 

										$sqltipoI = "SELECT * FROM tipos";
										$sqltipoI = $pdo->prepare($sqltipoI);
										$sqltipoI->execute();


											foreach($sqltipoI->fetchAll() as $dados):


											?>

											<option><?php echo $dados['tipo']?></option>

											<?php

											endforeach;	
									

									?>					
									</select>
								</div>
								<div class="form-group col-md-2">
										<label for="inputEmail4">Qtde</label>
										<input type="number" class="form-control" id="qtde" placeholder="Qtde" name="total[]" autocomplete="off" min="1" max="10">
								</div>
								<div class="form-group col-md-4">
										<label for="inputEmail4">Observação</label>
										<input type="text" class="form-control" id="inputEmail4" placeholder="Obs" name="obs[]" autocomplete="off">
								</div>
										
								<?php
							}

							?>


							<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
							<a href="itens.php" class="btn btn-primary btn-block">Voltar</a>
						</form>


					</div>
				</div>
			</body>
		</body>
		</html>


