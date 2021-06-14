<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/template.css">
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</head>
<body class="bg-color-bg bg-body-image">

	<div class="container-fluid" style="margin-top: 100px;">
		
			<div class="col">
				<div class="row justify-content-center" align="center">
					<span class="box-form-cad-usuarios">Deseja criar o banco de dados Malote e suas respectivas tabelas?</span>
				</div>
				<div class="row justify-content-center" align="center">
					<form method="POST">
						<div class="row justify-content-center mt-2">
							<span style="color: red; font-weight: 600;"><?php  include_once('criar_banco.php');?></span>
						</div>
						<button class="btn btn-primary mt-2">Criar Banco de Dados</button>
					</form>	
				</div>
			</div>
			
	</div>

</body>
</html>
