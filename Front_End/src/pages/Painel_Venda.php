<?php
    session_start();

    require_once '../../../Back_End/php/Main.php';
    require_once '../../../Back_End/php/Cadastrar_Vendas.php';
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
        if (isset($_POST['remover_produto'])) {
            $index = $_POST['remover_produto'];
            unset($_SESSION['produtos'][$index]);
            $_SESSION['produtos'] = array_values($_SESSION['produtos']);
        }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Paginas.css">
    <title>PDV - Registrar Venda</title>
</head>
<body class="page-vendas">
    
    <!-- Container Principal: Define as 3 colunas -->
    <div class="painel-vendas-container">
        
        <!-- COLUNA 1: Formulário (Esquerda) -->
        <aside class="painel-col-form">
            <h1 class="titulo-coluna">Registrar Venda</h1>
            <form method="POST" action="">
                <label for="nome">Nome do Produto:</label>
                <input list="produtos" type="text" id="nome" name="nome" placeholder="Buscar..." required>
                <datalist id="produtos">
                    <?php Produtos() ?>
                </datalist>

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" value="1" required>

                <button name="cadastrar_produto" type="submit" class="btn-primary">Cadastrar Item</button>
            </form>
        </aside>

        <main class="painel-col-table">
            <div class="tabela-header">
                <h1 class="titulo-coluna">Itens da Venda</h1>
                <span class="badge-status">Ativo</span>
            </div>
            <div class="tabela-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Unitário</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php obter_produtos(); ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- COLUNA 3: Ações e Totais (Direita) -->
        <div class="painel-col-actions">
            <h1 class="titulo-coluna">Resumo</h1>
            
            <div class="infos">
                <div class="card-resumo">
                    <span class="card-label">Total de Vendas</span>
                    <strong class="card-valor">R$ <?php echo obter_total_vendas(); ?></strong>
                </div>
                <div class="card-resumo">
                    <span class="card-label">Qtd. Produtos</span>
                    <strong class="card-valor"><?php echo obter_total_produtos(); ?></strong>
                </div>
            </div>

            <div class="Opções">
                <form method="POST" action="">
                    <button name="fechar_compra" id="fechar_compra" type="submit" method="POST" class="btn-finalizar">✅ Finalizar Compra</button>
                    <button name="cancelar_compra" id="cancelar_compra" type="submit" method="POST" class="btn-cancelar">❌ Cancelar</button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
<script src="../Scripts/script.js"></script>