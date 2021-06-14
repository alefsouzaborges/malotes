<?php 
require('classes/config-database.php');

?>
<head>
	<title>Sistema</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scalable=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/template.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body class="bg-color-bg bg-body-image">
	<div class="container-fluid">
		<div class="">
			<div class="row box-form">
				<div class="col-sm"> 
					<div class="form-titulo-login">
						<div class="img-logo justify-content-center">
							<img src="assets/images/logo01.png" width="110">
						</div>
					</div>
					<div class="row justify-content-center align-itens-center">
						<div class="col-sm mr-0 form-login-mt">
							<form class="form-signin" method="POST">
								<div class="form-group">
									<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" autocomplete="off">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="senha">
								</div>
								<div class="row justify-content-center">
									<small class="mr-3 valida-usuario"><?php require('classes/validar-usuario.php'); ?></small>
								</div>
								<button type="submit" class="btn btn-color-bg btn-block">Logar</button>
							</form>
						</div>
					</div>
					<div class="row justify-content-end">
						<small class="text-color mr-3">versão: 1.0.0</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</div>
