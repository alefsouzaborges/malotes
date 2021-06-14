<?php
include_once('validar-usuario.php');
include_once('../assets/fpdf/fpdf.php');
include_once('valida-sessao.php');
include_once('config-database.php');


try {

	



	$sql = "SELECT * FROM motoristas";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	
	$pdf = new FPDF();
	$pdf->AddPage('');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(190,10,utf8_decode('Relatório de cadastro de motoristas'),0,0,"C");
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,7,'Codigo',1,0,"C");
	$pdf->Cell(45,7,'Nome',1,0,"C");
	$pdf->Cell(65,7,'Telefone',1,0,"C");
	$pdf->Ln(7);

	foreach ($sql as $dados) {
		$pdf->SetFont('Arial','I',10);
		$pdf->Cell(15,7,utf8_decode($dados["id"]),1,0,"C");
		$pdf->Cell(45,7,utf8_decode($dados["nome"]),1,0,"C");
		$pdf->Cell(65,7,utf8_decode($dados["telefone"]),1,0,"C");
		

		$pdf->Ln(7);
	}

	$pdf->output();

	
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>

