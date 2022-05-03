<?php
    require_once('conexao.php');
    
    $procedimento = $_POST['procedimento'];
    $data_ini = $_POST['data_ini'];
    $data_final = $_POST['data_final'];

    function data($data){
        return date("d/m/Y", strtotime($data));
    }
    
    $dataInicial = data($data_ini);
    $dataFinal = data($data_final);
    
    $sql = "SELECT cd_atendimento,atendime.cd_paciente,nm_paciente,cd_pro_int,pro_fat.ds_pro_fat,dt_atendimento from paciente,atendime,pro_fat 
    where paciente.cd_paciente = atendime.cd_paciente and atendime.cd_pro_int = pro_fat.cd_pro_fat and atendime.cd_pro_int = $procedimento 
    and dt_atendimento between '$dataInicial' and '$dataFinal'";
    $query = oci_parse($conexao,$sql);
    oci_execute($query);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Relatório</title>
</head>
<body>

    <div class="container">
        <h3 id="title-relatorio">Relatório Por Procedimento - MV</h2>
        <table class="table table-light table-hover" id="tab-relatorio">
            <tr class="table-dark">
                <th>#</th>
                <th>CD ATENDIMENTO</th>
                <th>CD PACIENTE</th>
                <th>NOME PACIENTE</th>
                <th>CD PROCEDIMENTO</th>
                <th>PROCEDIMENTO</th>
                <th>DT ATENDIMENTO</th>
            </tr>
        <?php while ($row = oci_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo oci_num_rows($query) ?></td>
                <td><?php echo $row['CD_ATENDIMENTO'] ?></td>
                <td><?php echo $row['CD_PACIENTE'] ?></td>
                <td><?php echo $row['NM_PACIENTE'] ?></td>
                <td><?php echo $row['CD_PRO_INT'] ?></td>
                <td><?php echo $row['DS_PRO_FAT'] ?></td>
                <td style="text-align:center;"><?php echo $row['DT_ATENDIMENTO'] ?></td>
            </tr>
        <?php } ?>
        </table>
        
        <div id="rodape">
            <form action="gerar_planilha.php" method="POST">
                <input type="hidden" value="<?php echo $procedimento ?>" name="procedimento" >
                <input type="hidden" value="<?php echo $dataInicial ?>" name="dataInicial" >
                <input type="hidden" value="<?php echo $dataFinal ?>" name="dataFinal" >
                <input type="submit" id="voltar" value="Gerar Planilha">
            </form>
        </div>   
        
        <div id="retornar">
            <a id="voltar" href="index.php"><button>Voltar</button></a>
        </div>
                            
    </div>
    
</body>
</html>