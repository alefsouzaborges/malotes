<?php
include_once('validar-usuario.php');
include_once('../assets/fpdf/fpdf.php');
include_once('valida-sessao.php');
include_once('config-database.php');

try {

	$unidade_logada = $_SESSION['unidade'];


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
	WHERE  remetente = $unidade_logada  AND movimentoc.status = 'Rejeitado' or destinatario = $unidade_logada
	ORDER BY lacre DESC";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	
	$pdf = new FPDF();
	$pdf->AddPage('O');
	$pdf->SetFont('Arial','B',16);
	$pdf->SetLeftMargin(20);
	$pdf->Cell(190,10,utf8_decode('Relatório de malotes rejeitados'),0,0,"C");
	$pdf->Ln(15);
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,7,'Lacre',1,0,"C");
	$pdf->Cell(35,7,'Usuario',1,0,"C");
	$pdf->Cell(25,7,'Remetente',1,0,"C");
	$pdf->Cell(25,7,'Destinatario',1,0,"C");
	$pdf->Cell(18,7,'Tipo',1,0,"C");
	$pdf->Cell(25,7,'Motorista',1,0,"C");
	$pdf->Cell(25,7,'Transporte',1,0,"C");
	$pdf->Cell(18,7,'Status',1,0,"C");
	$pdf->Cell(50,7,'Motivo',1,0,"C");
	$pdf->Cell(15,7,'Datamvto',1,0,"C");
	$pdf->Cell(12,7,'Hora',1,0,"C");
	$pdf->Ln(7);

	foreach ($sql as $dados) {
		$pdf->SetFont('Arial','I',7);
		$pdf->cell(10,7,utf8_decode($dados["lacre"]),1,0,"C");
		$pdf->Cell(35,7,utf8_decode($dados["usuario"]),1,0,"C");
		$pdf->Cell(25,7,utf8_decode($dados["remetente"]),1,0,"C");
		$pdf->Cell(25,7,utf8_decode($dados["destinatario"]),1,0,"C");
		$pdf->Cell(18,7,utf8_decode($dados["tipo"]),1,0,"C");
		$pdf->Cell(25,7,utf8_decode($dados["motorista"]),1,0,"C");
		$pdf->Cell(25,7,utf8_decode($dados["transporte"]),1,0,"C");
		$pdf->Cell(18,7,utf8_decode($dados["status"]),1,0,"C");
		$pdf->Cell(50,7,utf8_decode($dados["motivo"]),1,0,"C");
		$pdf->Cell(15,7,utf8_decode($dados["datamvto"]),1,0,"C");
		$pdf->Cell(12,7,utf8_decode($dados["hora"]),1,0,"C");
		

		$pdf->Ln(7);
	}


	$pdf->output();


	
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>

