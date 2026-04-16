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
            $conditions[] = "mes_ano = ?";
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

    function buscarDadosGrafico($mysqli, $periodo, $categoria, $produto) {
        $labels = [];
        $valores = [];

        $sql = "SELECT mes_ano, SUM(Total_faturado) AS total FROM vendas";
        $conditions = [];
        $types = '';
        $params = [];

        if ($periodo !== '') {
            $conditions[] = "mes_ano = ?";
            $types .= 's';
            $params[] = $periodo;
        }
        if ($categoria !== '') {
            $conditions[] = "categoria = ?";
            $types .= 's';
            $params[] = $categoria;
        }
        if ($produto !== '') {
            $conditions[] = "produto = ?";
            $types .= 's';
            $params[] = $produto;
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
        $sql .= " GROUP BY mes_ano ORDER BY mes_ano";

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            error_log("Erro na query: " . $mysqli->error);
            return ['labels' => [], 'valores' => []];
        }
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            error_log("Erro na execução: " . $stmt->error);
            return ['labels' => [], 'valores' => []];
        }
        $result = $stmt->get_result();

        if ($result){
            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['mes_ano'];
                $valores[] = (float)$row['total'];
            }
        }
        return[
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Total Faturado',
                'data' => $valores,
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'tension' => 0.4,
                'fill' => true
            ]]
        ];
    }
?>