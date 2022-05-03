<?php 
    require('conexao.php');
    $procedimento = $_POST['procedimento'];
    $dataInicial = $_POST['dataInicial'];
    $dataFinal = $_POST['dataFinal'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XLSX</title>
</head>
<body>

    <?php
    $arquivo = 'relatorio.xls';

    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    $html .= '<td colspan="7" style="text-align:center;font-size:16px">Relatorio Por Procedimentos</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td><b>Indice</b></td>';
    $html .= '<td><b>Cod Atendimento</b></td>';
    $html .= '<td><b>Cod Paciente</b></td>';
    $html .= '<td><b>Nome Paciente</b></td>';
    $html .= '<td><b>Cod Procedimento</b></td>';
    $html .= '<td><b>Procedimento</b></td>';
    $html .= '<td><b>Data Atendimento</b></td>';
    $html .= '</tr>';

    
	$result_relatorio = 
    "SELECT cd_atendimento,atendime.cd_paciente,nm_paciente,cd_pro_int,pro_fat.ds_pro_fat,dt_atendimento from paciente,atendime,pro_fat 
    where paciente.cd_paciente = atendime.cd_paciente and atendime.cd_pro_int = pro_fat.cd_pro_fat and atendime.cd_pro_int = $procedimento 
    and dt_atendimento between '$dataInicial' and '$dataFinal'";

    $resultado_relatorio = oci_parse($conexao,$result_relatorio);
    oci_execute($resultado_relatorio);
		
	while($row_relatorio = oci_fetch_assoc($resultado_relatorio)){
		$html .= '<tr>';
		$html .= '<td>'.oci_num_rows($resultado_relatorio).'</td>';
		$html .= '<td>'.$row_relatorio["CD_ATENDIMENTO"].'</td>';
		$html .= '<td>'.$row_relatorio["CD_PACIENTE"].'</td>';
		$html .= '<td>'.$row_relatorio["NM_PACIENTE"].'</td>';
        $html .= '<td>'.$row_relatorio["CD_PRO_INT"].'</td>';
        $html .= '<td>'.$row_relatorio["DS_PRO_FAT"].'</td>';
        $html .= '<td>'.$row_relatorio["DT_ATENDIMENTO"].'</td>';
		$html .= '</tr>';
		;
	}

    // Configurações header para forçar o download
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/x-msexcel");
	header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
	header ("Content-Description: PHP Generated Data" );
	
	echo $html;
	exit; ?>
    

    ?>
    
</body>
</html>