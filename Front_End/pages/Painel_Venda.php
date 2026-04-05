<?php
    session_start();
    
    require_once '../../Back_End/php/Main.php';
    require_once '../../Back_End/php/Cadastrar_Vendas.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['cadastrar_produto'])) {
            Adicionar_Produto($mysqli);
        }
        if (isset($_POST['cancelar_compra'])) {
            cancelar_compra($mysqli);
        }
        if (isset($_POST['fechar_compra'])) {
            fechar_compra($mysqli);
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/paginas.css">
    <title>Cadastro de Produto</title>
</head>
<body>
    <aside>
        <h1> Registrar venda</h1>
        <form method="POST" action="">
            <label for="nome">Nome do Produto:</label>
            <input list="produtos" type="text" id="nome" name="nome" required>
            <datalist id="produtos">
                <?php Produtos() ?>
            </datalist>


            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value=1 required>

            <button name="cadastrar_produto" type="submit">Cadastrar</button>
        </form>
    </aside>

    <main>
        <h1>Vendas Registradas</h1>
        <table>
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody> <?php obter_produtos(); ?></tbody>
        </table>
    </main>
    <div class="Caixa_direita">
        <div class="infos">
            <div class="card">
            <span class="card-label">Total de Vendas</span>
            <strong class="card-valor">R$ <?php echo obter_total_vendas(); ?></strong>
        </div>
        <div class="card">
            <span class="card-label">Qtd. Produtos</span>
            <strong class="card-valor"><?php echo obter_total_produtos(); ?></strong>
        </div>
        </div>
        <div class="Opções">
            <form method="POST" action="">
                <button name="cancelar_compra" type="submit">Cancelar</button>
            </form>
            <form method="POST" action="">
                <button name="fechar_compra" type="submit">Finalizar</button>
            </form>     
        </div>
    </div>
</div>
</body>
</html>
<script src="../Script.js"></script>