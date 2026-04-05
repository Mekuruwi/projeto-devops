<?php
    
    $host = "localhost:3306";
    $banco = "projeto_devops";
    $usuario = "root";
    $senha = "kevin5516ex";

    $mysqli = new mysqli($host, $usuario, $senha, $banco);

    if ($mysqli->connect_error) {
        die("Erro na conexão: " . $mysqli->connect_error);
    }

    $mysqli->set_charset("utf8mb4");

?>