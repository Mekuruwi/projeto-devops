<?php

    session_start();

    if(!isset($_SESSION['produtos'])) {
        $_SESSION['produtos'] = [];
    }

    if(!isset($mysqli)) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    require_once 'Conexao.php';


    function pesquisar_valor($mysqli, $nome_produto) {
        $stmt = $mysqli->prepare("SELECT preco FROM produtos WHERE nome = ?");
        $stmt->bind_param("s", $nome_produto);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['preco'];
        } else {
            return null;
        }
    }

    function adicionar_produto($mysqli) {
        $categoria = $_POST['categoria'];
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $valor_unitario = pesquisar_valor($mysqli, $nome);
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
            
            $stmt = $mysqli->prepare("INSERT INTO vendas (categoria, produto, preco, quantidade, Total_faturado, Data_registro) VALUES (?, ?, ?, ?, ?, ?)");
            
            $stmt->bind_param("ssdids",
                $categoria,
                $nome,
                $valor_unitario,
                $quantidade,
                $total,          
                $data_registro           
            );
            
            $stmt->execute();
        }
        session_destroy();
    }

?>