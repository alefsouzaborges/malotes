<?php
include_once('validar-usuario.php');
include_once('../assets/fpdf/fpdf.php');
include_once('valida-sessao.php');
include_once('config-database.php');


try {


	$sql = "SELECT * FROM unidades";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	
	$pdf = new FPDF();
	$pdf->AddPage('O');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(190,10,utf8_decode('Relatório de Cadastro de Usuários'),0,0,"C");
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,7,'Codigo',1,0,"C");
	$pdf->Cell(35,7,'Cnpj',1,0,"C");
	$pdf->Cell(50,7,utf8_decode('Razão Social'),1,0,"C");
	$pdf->Cell(15,7,'Uf',1,0,"C");
	$pdf->Cell(60,7,'Cidade',1,0,"C");
	$pdf->Cell(80,7,utf8_decode('Endereço'),1,0,"C");
	$pdf->Cell(17,7,'Numero',1,0,"C");

	$pdf->Ln(7);

	foreach ($sql as $dados) {
		$pdf->SetFont('Arial','I',10);
		$pdf->Cell(15,7,utf8_decode($dados["id"]),1,0,"C");
		$pdf->Cell(35,7,utf8_decode($dados["cnpj"]),1,0,"C");
		$pdf->Cell(50,7,utf8_decode($dados["razaosocial"]),1,0,"C");
		$pdf->Cell(15,7,utf8_decode($dados["uf"]),1,0,"C");
		$pdf->Cell(60,7,utf8_decode($dados["cidade"]),1,0,"C");
		$pdf->Cell(80,7,utf8_decode($dados["endereco"]),1,0,"C");
		$pdf->Cell(17,7,utf8_decode($dados["numero"]),1,0,"C");

		$pdf->Ln(7);
	}

	$pdf->output();

	
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>

