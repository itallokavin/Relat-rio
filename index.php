<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Index</title>
</head>

<body>
    
    <div class="container">
        <div id="box">
            <div class="title-index">
                <h3 class="centralizar">Relatório por procedimento MV.</h3>
            </div>
            <form action="relatorio.php" method="POST">
                <div class="form-group procedimento">
                    <label for="procedimento">Procedimento:</label>
                    <input type="text" name="procedimento" class="form-control" id="procedimento">
                </div>
                <div class="form-group date">
                    <label>Data Intervalo:</label>
                    <input type="date" name="data_ini" class="form-control" id="data1">
                    <span>à</span>
                    <input type="date" name="data_final" class="form-control" id="data2">
                </div>
                <div class="form-group">
                    <input id="buscar" type="submit" class="form-control" value="Buscar">
                </div>
                <div class="footer">
                    <span>&copy Itallo Kavin</span>
                </div>
            </form>
        </div>
    </div>

</body>
</html>