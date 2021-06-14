<?php

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	
}else{
	header('Location: login.php');
}

?>