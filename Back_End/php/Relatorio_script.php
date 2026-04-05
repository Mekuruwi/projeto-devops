<?php
require_once 'Conexao.php'; 


$dadosRelatorio = [];

function Filtrar($mysqli, $Periodo, $Categoria, $Produto) {
    global $dadosRelatorio;

    $sql = "SELECT * FROM vendas";
    $conditions = [];
    $types = '';
    $params = [];

    
    if ($Periodo !== '') {
        $conditions[] = "Data_registro >= ?";
        $types .= 's';
        $params[] = $Periodo;
    }
    if ($Categoria !== '') {
        $conditions[] = "categoria = ?";
        $types .= 's';
        $params[] = $Categoria;
    }
    if ($Produto !== '') {
        $conditions[] = "produto = ?";
        $types .= 's';
        $params[] = $Produto;
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        error_log("Erro na query: " . $mysqli->error);
        $dadosRelatorio = [];
        return;
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    
    $dadosRelatorio = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

function Total_Faturado() {
    global $dadosRelatorio;
    $total = 0;
    foreach ($dadosRelatorio as $venda) {
        $total += (float)($venda['Total_faturado'] ?? 0);
    }
    return $total;
}

function Volume() {
    global $dadosRelatorio;
    $volume = 0;
    foreach ($dadosRelatorio as $venda) {
        $volume += (int)($venda['quantidade'] ?? 0);
    }
    return $volume;
}
function Ticket_medio() {
    $volume = Volume();
    $total_faturado = Total_Faturado();
    if ($volume > 0) {
        $ticket_medio = $total_faturado / $volume;
    } else {
        $ticket_medio = 0;
    }
    return $ticket_medio;
}
?>