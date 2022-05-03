<?php 
    require_once('conexao.php');
    $sql = "SELECT * from paciente where nm_paciente LIKE 'ITALLO%'";
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
    <title>Relatorio</title>

    <style>
        th{
            border: 1px solid black;
            width:250px;
        }
    </style>
</head>
<body>

    <div class="container" style="text-align:center;">

        <h2>Relatório</h2>

        <table class="table">
            <tr class="table-dark">
                <th>CODIGO</th>
                <th>NOME</th>
                <th>ENDEREÇO</th>
                <th>DATA NASCIMENTO</th>
            </tr>
        <?php while ($row = oci_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $row['CD_PACIENTE'] ?></td>
                <td><?php echo $row['NM_PACIENTE'] ?></td>
                <td><?php echo $row['DS_ENDERECO'] ?></td>
                <td><?php echo $row['DT_NASCIMENTO'] ?></td>
            </tr>
        <?php } ?>
        </table>
        
    </div>




</body>
</html>