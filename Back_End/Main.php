<?php
    require_once 'Conexao.php';
    
    Function BuscarProdutos($mysqli) {
        $dados = Produtos_registrados($mysqli);
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Categoria</th><th>Preço</th></tr>";   
        
        while ($produto = $dados->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $produto['id'] . "</td>";
            echo "<td>" . $produto['nome'] . "</td>";
            echo "<td>" . $produto['categoria'] . "</td>";
            echo "<td>R$ " . number_format($produto['preco'], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    }
    function Produtos_registrados($mysqli) {
        $dados = $mysqli->query("SELECT * FROM produtos");
        return $dados;
    } 
?>