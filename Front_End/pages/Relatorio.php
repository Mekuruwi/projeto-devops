<?php

$Periodo   = $_GET['Periodo'] ?? '';
$Categoria = $_GET['Categoria'] ?? '';
$Produto   = $_GET['Produto'] ?? '';

require_once '../../Back_End/php/Main.php';
require_once '../../Back_End/php/Relatorio_script.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Filtrar'])) {
        Filtrar($mysqli, $Periodo, $Categoria, $Produto);
    } else {
         Filtrar($mysqli, '', '', '');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Paginas.css">
    <title>Relatório</title>
</head>
<body>
  
    <aside>
        <h1>Filtrar</h1>

        <form method="GET" action="">
            <label for="Periodo">Período:</label>
            <input list="periodos" type="text" id="Periodo" name="Periodo" value="<?= htmlspecialchars($Periodo) ?>">
            <datalist id="periodos">
                <?php Periodos() ?>
            </datalist> 

            <label for="Categoria">Categoria:</label>
            <input list="categorias" type="text" id="Categoria" name="Categoria" value="<?= htmlspecialchars($Categoria) ?>">

            <datalist id="categorias">
                <?php Categorias() ?>
            </datalist> 

            <label for="Produto">Produto:</label>
            <input list="produtos" type="text" id="Produto" name="Produto" value="<?= htmlspecialchars($Produto) ?>">

            <datalist id="produtos">
                <?php Produtos() ?>
            </datalist>

            <button name="Filtrar" type="submit">Filtrar</button>
        </form>
    </aside>

    <main>
        <div class="Caixa_direita">
            <div class="infos">
                <div class="card">
                    <span class="card-label">Total de Vendas</span>
                    <strong class="card-valor">R$ <?= htmlspecialchars(number_format(Total_Faturado(), 2, ',', '.')) ?></strong>
                </div>
                <div class="card">
                    <span class="card-label">Qtd. Produtos</span>
                    <strong class="card-valor"><?= htmlspecialchars(number_format(Volume(), 0, ',', '.')) ?></strong>
                </div>
                <div class="card">
                    <span class="card-label">Ticket Médio</span>
                    <strong class="card-valor">R$ <?= htmlspecialchars(number_format(Ticket_medio(), 2, ',', '.')) ?></strong>
                </div>
            </div>
        </div>
        <div class="grafics">
            <canvas id="myChart"></canvas>
        </div>

    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script></script>
</html>
