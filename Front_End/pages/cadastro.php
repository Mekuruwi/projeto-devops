<?php
    require_once '../../Back_End/Main.php';
    require_once '../../Back_End/Cadastrar_Produto.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_produto'])) {
        CadastrarNovosProdutos($mysqli);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Paginas.css">
    <title>cadastro</title>
</head>
<body>
    <aside>
        <h1> Cadastrar Novo Produto</h1>
        <form method="POST" action="">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>

            <label for="preco">Preço:</label>
            <input type="number" step="0.01" id="preco" name="preco" required>

            <button name="cadastrar_produto" type="submit">Cadastrar</button>
        </form>
    </aside>
    <main>
        <h1>Produtos Cadastrados</h1>
        <?php BuscarProdutos($mysqli) ?>
    </main>
</body>
</html>