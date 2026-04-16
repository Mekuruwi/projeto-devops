<?php
    
    require_once __DIR__ . '/../../vendor/autoload.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['db_host'];
    $banco = $_ENV['db_name'];
    $usuario = $_ENV['db_user'];
    $senha = $_ENV['db_password'];

    $mysqli = new mysqli($host, $usuario, $senha, $banco);

    if ($mysqli->connect_error) {
        die("Erro na conexão: " . $mysqli->connect_error);
    }

    $mysqli->set_charset("utf8mb4");

?>