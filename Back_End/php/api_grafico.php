<?php
    header('Content-Type: application/json');
    require_once 'relatorio_script.php';
    require_once 'Conexao.php';

    $periodo = $_GET['Periodo'] ?? '';
    $categoria = $_GET['Categoria'] ?? '';
    $produto = $_GET['Produto'] ?? '';

    $dados = buscarDadosGrafico($mysqli, $periodo, $categoria, $produto);

    echo json_encode($dados);
    
    exit;
?>