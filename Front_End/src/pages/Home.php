<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Home.css">
    <title>Home</title>
</head>
<body>
    <nav class="logo">
        <ul class="nav-links">
            <li><a href="cadastro.php" target="mainFrame">Cadastrar</a></li>
            <li><a href="Painel_Venda.php" target="mainFrame">Vendas</a></li>
            <li><a href="Relatorio.php" target="mainFrame">Relatório</a></li>
        </ul>
        
        <button class="theme-toggle" id="themeToggle">
            <span class="sun">☀️</span>
            <span class="moon">🌙</span>
        </button>
    </nav>

    <iframe name="mainFrame" src="Relatorio.php" width="100%" height="100%"></iframe>

    <footer>
        <p>&copy; 2026 Projeto DevOps. Todos os direitos reservados.</p>
    </footer>

    <script src="../js/Script.js"></script>
</body>
</html>