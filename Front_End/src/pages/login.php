<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Painel de vendas</title>
    <link rel="stylesheet" href="../styles/Login.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-header">
            <div class="icon">⚔</div>
            <h2>Acesso ao Sistema</h2>
        </div>
        
        <?php if($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form action="../../../Back_End/php/Auth/login_handler.php" method="POST" class="login-form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required autocomplete="email">
            
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
            
            <button type="submit">Entrar</button>
        </form>
        
        <div class="login-footer">
            <a href="#">Recuperar senha</a>
        </div>
    </div>
</body>
</html>