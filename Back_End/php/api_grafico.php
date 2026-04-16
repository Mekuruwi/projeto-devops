<?php
    header('Content-Type: application/json');
    require_once 'php/Conexao.php';
    $periodo = '';
    $categoria = '';
    $produto = '';
    $periodo = $_GET['Periodo'] ?? '';
    $categoria = $_GET['Categoria'] ?? '';
    $produto = $_GET['Produto'] ?? '';
?>