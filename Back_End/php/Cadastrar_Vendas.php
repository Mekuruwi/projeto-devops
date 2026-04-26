<?php

    
    if(!isset($_SESSION['produtos'])) {
        $_SESSION['produtos'] = [];
    }

    if(!isset($mysqli)) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    require_once 'Conexao.php';


    function pesquisar_valor($mysqli, $nome_produto) {
        $stmt = $mysqli->prepare("SELECT preco, categoria FROM produtos WHERE nome = ?");
        $stmt->bind_param("s", $nome_produto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    function adicionar_produto($mysqli) {
        $pesquisa = pesquisar_valor($mysqli, $_POST['nome']);
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $valor_unitario = $pesquisa['preco'];
        $categoria = $pesquisa['categoria'];
        $Total = $quantidade * $valor_unitario;

        $_SESSION['produtos'][] = ['categoria' => $categoria, 'nome' => $nome, 'quantidade' => $quantidade, 'valor_unitario' => $valor_unitario, 'total' => $Total];
    }
    
    function obter_produtos() {
        global $_SESSION;
        while ($produto = current($_SESSION['produtos'])) {
            echo "<tr>
                    <td>{$produto['categoria']}</td>
                    <td>{$produto['nome']}</td>
                    <td>{$produto['quantidade']}</td>
                    <td>R$ " . number_format($produto['valor_unitario'], 2, ',', '.') . "</td>
                    <td>R$ " . number_format($produto['total'], 2, ',', '.') . "</td>
                    <td><form method='POST' action=''><button name='remover_produto' value='" . key($_SESSION['produtos']) . "' type='submit'>Remover</button></form></td>
                </tr>";
            next($_SESSION['produtos']);
        }
    }


    function obter_total_vendas() {
        global $_SESSION;
        $total_vendas = 0;
        foreach ($_SESSION['produtos'] as $produto) {
            $total_vendas += $produto['total'];
        }
        return number_format($total_vendas, 2, ',', '.');
    }

    function obter_total_produtos() {
        global $_SESSION;
        $total_produtos = 0;
        foreach ($_SESSION['produtos'] as $produto) {
            $total_produtos += $produto['quantidade'];
        }
        return $total_produtos;
    }

    function cancelar_compra() {
        session_destroy();
    }

    function fechar_compra() {
        global $_SESSION, $mysqli;
        foreach ($_SESSION['produtos'] as $produto) {

            $categoria = $produto['categoria'];
            $nome = $produto['nome'];
            $quantidade = $produto['quantidade'];
            $valor_unitario = $produto['valor_unitario'];
            $total = $produto['total'];
            $data_registro = date('Y-m-d H:i:s');
            $mes_ano = Formatar_data($data_registro);

            $stmt = $mysqli->prepare("INSERT INTO vendas (categoria, produto, preco, quantidade, Total_faturado, Data_registro, mes_ano) VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->bind_param("ssdidss",
                $categoria,
                $nome,
                $valor_unitario,
                $quantidade,
                $total,          
                $data_registro,
                $mes_ano           
            );
            
            $stmt->execute();

            $stmt = $mysqli->prepare("UPDATE produtos SET estoque = estoque - ? WHERE nome = ?");
            $stmt->bind_param("is", $quantidade, $nome);
            $stmt->execute();

            $_SESSION['produtos'] = [];
        }
        session_destroy();
    }

    function Formatar_data($data) {
        $timestamp = strtotime($data);
        if ($timestamp === false) {
            return '';
        }

        $meses = [
            1 => 'jan',
            2 => 'fev',
            3 => 'mar',
            4 => 'abr',
            5 => 'mai',
            6 => 'jun',
            7 => 'jul',
            8 => 'ago',
            9 => 'set',
            10 => 'out',
            11 => 'nov',
            12 => 'dez',
        ];

        $mes = (int) date('n', $timestamp);
        $ano = date('Y', $timestamp);

        return sprintf('%s/%s', $meses[$mes], $ano);    
    }

?>