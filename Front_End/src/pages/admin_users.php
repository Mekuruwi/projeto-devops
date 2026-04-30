<?php
    require_once '../../../Back_End/php/users.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remover_usuario'])) {
        RemoverUsuario($mysqli, $_POST['remover_usuario']);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Criar_usuario'])) {
        CriarUsuario($mysqli, $_POST['username'], $_POST['email'], $_POST['password']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Paginas.css">
    <title>Adm</title>
</head>
<body>
    <aside class="sidebar">
        <h1>cadastrar novo usuário</h1>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="" required>
            <button type="submit" name="Criar_usuario">Cadastrar Produto</button>
        </form>
    </aside>
    <main>
        <h1>Usuários Cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Criado em</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php Listar_usuarios($mysqli) ?>
            </tbody>
        </table>
    </main>
</body>
</html>