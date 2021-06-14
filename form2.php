<?php
if(isset($_GET['usuarios'])){
	$chkCadUsuarios = "S";
}else{
	$chkCadUsuarios = "N";
}

echo $chkCadUsuarios;

?>