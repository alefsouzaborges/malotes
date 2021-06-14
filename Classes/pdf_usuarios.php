<?php
include_once('validar-usuario.php');
include_once('../assets/fpdf/fpdf.php');
include_once('valida-sessao.php');
include_once('config-database.php');


try {

	if(isset($_POST['nivel'])){
	
	$nivel = $_POST['nivel'];
	$razao = $_POST['razao'];
	$status = $_POST['status'];
	$unidade = $_POST['unidade'];

	if($nivel == "Todos"){
		$nivel = "%%";
	}else{
		$nivel = $_POST['nivel'];
	}
	if($razao == "Todos"){
		$razao = '%%';
	}else{
		$razao == $_POST['razao'];
	}
	if($unidade == "Todos"){
		$unidade = '%%';
	}else{
		$unidade = $_POST['unidade'];
	}
	if($status == "Todos"){
		$status = '%%';
	}else{
		$status = $_POST['status'];
	}


}

	$sql = "SELECT usua.id,nome,email,nivel,status,online,unidade,razaosocial FROM usuarios AS usua
			INNER JOIN unidades AS unid ON (usua.unidade = unid.id) WHERE nivel LIKE :nivel AND status LIKE :status AND razaosocial LIKE :razaosocial AND Unidade LIKE :unidades";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(':nivel',$nivel);
	$sql->bindValue(':status',$status);
	$sql->bindValue(':razaosocial',$razao);
	$sql->bindValue(':unidades',$unidade);
	$sql->execute();
	
	$pdf = new FPDF();
	$pdf->AddPage('O');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(190,10,utf8_decode('Relatório de Cadastro de Usuários'),0,0,"C");
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,7,'Codigo',1,0,"C");
	$pdf->Cell(45,7,'Nome',1,0,"C");
	$pdf->Cell(65,7,'Email',1,0,"C");
	$pdf->Cell(30,7,'Nivel',1,0,"C");
	$pdf->Cell(20,7,'Status',1,0,"C");
	$pdf->Cell(17,7,'Unidade',1,0,"C");
	$pdf->Cell(70,7,utf8_decode('Razão Social'),1,0,"C");
	$pdf->Ln(7);

	foreach ($sql as $dados) {
		$pdf->SetFont('Arial','I',10);
		$pdf->Cell(15,7,utf8_decode($dados["id"]),1,0,"C");
		$pdf->Cell(45,7,utf8_decode($dados["nome"]),1,0,"C");
		$pdf->Cell(65,7,utf8_decode($dados["email"]),1,0,"C");
		$pdf->Cell(30,7,utf8_decode($dados["nivel"]),1,0,"C");
		$pdf->Cell(20,7,utf8_decode($dados["status"]),1,0,"C");
		$pdf->Cell(17,7,utf8_decode($dados["unidade"]),1,0,"C");
		$pdf->Cell(70,7,utf8_decode($dados["razaosocial"]),1,0,"C");

		$pdf->Ln(7);
	}

	$pdf->output();

	
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>

