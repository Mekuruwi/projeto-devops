<?php
    require_once 'Conexao.php';
    
    Function BuscarProdutos($mysqli) {
        $dados = Produtos_registrados($mysqli);

        echo "<table>";
        echo "<tr><th>Nome</th><th>Categoria</th><th>Preço</th><th>Modificar</th><th>Excluir</th></tr>";   
        
        while ($produto = $dados->fetch_assoc()) {
            echo "<tr>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='id' value='" . $produto['id'] . "'>";
            echo "<td><input id='nome' name='nome' type='text' value='" . $produto['nome'] . "' ></td>";
            echo "<td><input id='categoria' name='categoria' type='text' value='" . $produto['categoria'] . "' ></td>";
            echo "<td><input id='preco' name='preco' type='text' value='R$ " . number_format($produto['preco'], 2, ',', '.') . "' ></td>";
            echo "<td><button type='submit' name='editar_produto' value='" . $produto['id'] . "'>Editar</button></td>";
            echo "<td><button type='submit' name='excluir_produto' value='" . $produto['id'] . "'>Excluir</button></td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table><br>";
    }
    function Produtos_registrados($mysqli) {
        $dados = $mysqli->query("SELECT * FROM produtos");
        return $dados;
    }
    function ExcluirProduto($mysqli, $id) {
        $stmt = $mysqli->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Produto excluído com sucesso!";
        } else {
            return "Erro ao excluir produto: " . $stmt->error;
        }
        $stmt->close();
    }

    function EditarProduto($mysqli, $id, $nome, $categoria, $preco) {
        $preco = trim($preco);
        $preco = str_replace(['R$', 'r$', ' ', '.'], '', $preco);
        $preco = str_replace(',', '.', $preco);
        $preco = (float) $preco;

        $stmt = $mysqli->prepare("UPDATE produtos SET nome = ?, categoria = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $nome, $categoria, $preco, $id);
        if ($stmt->execute()) {
            return "Produto atualizado com sucesso!";
        } else {
            return "Erro ao atualizar produto: " . $stmt->error;
        }
        $stmt->close();
    }
    function Produtos() {
        global $mysqli;
        $result = $mysqli->query("SELECT nome FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['nome']) . "'>" . htmlspecialchars($row['nome']) . "</option>";
        }
    }
    function Categorias() {
        global $mysqli;
        $result = $mysqli->query("SELECT DISTINCT categoria FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['categoria']) . "'>" . htmlspecialchars($row['categoria']) . "</option>";
        }
    }
    function Periodos() {
        global $mysqli;
        $result = $mysqli->query("SELECT DISTINCT mes_ano FROM vendas");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['mes_ano']) . "'>" . htmlspecialchars($row['mes_ano']) . "</option>";
        }
    }

?>