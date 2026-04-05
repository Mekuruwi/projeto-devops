<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Home</title>
</head>
<body>
    <nav class="logo">
        <ul>
            <li><a href="pages/cadastro.php" target="mainFrame">Cadastrar</a></li>
            <li><a href="pages/Painel_Venda.php" target="mainFrame">Vendas</a></li>
            <li><a href="pages/Relatorio.php" target="mainFrame">Relatório</a></li>
        </ul>
    </nav>

    <iframe name="mainFrame" src="pages/Painel_Venda.php" width="100%" height="100%"></iframe>

    <footer>
        <p>&copy; 2026 Projeto DevOps. Todos os direitos reservados.</p>
    </footer>
</body>
</html>