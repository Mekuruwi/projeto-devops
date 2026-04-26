<?php
// Back_End/php/Auth/login_handler.php

// ✅ Caminho correto sobe 1 pasta (de Auth/ para php/)
require_once __DIR__ . '/../Conexao.php';

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,        // ❌ Mude para true APENAS em produção com HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Projeto_DevOps/Front_End/src/pages/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$error = '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Email inválido.';
} elseif (empty($password)) {
    $error = 'Senha obrigatória.';
}

if (!$error) {
    // 🔹 Prepared Statement com mysqli
    $stmt = $mysqli->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true); // Proteção contra fixação de sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;

            // Redireciona para a página desejada ou padrão
            $redirect = $_GET['redirect'] ?? '/Projeto_DevOps/Front_End/src/pages/Home.php';
            header("Location: $redirect");
            exit;
        } else {
            $error = 'Email ou senha incorretos.';
        }
        $stmt->close();
    } else {
        $error = 'Erro interno ao preparar consulta.';
        error_log("MySQLi Prepare Error: " . $mysqli->error);
    }
}

$_SESSION['login_error'] = $error;
header('Location: /Projeto_DevOps/Front_End/src/pages/login.php');
exit;