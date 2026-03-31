    <?php

        require_once 'Conexao.php';

        function CadastrarNovosProdutos($mysqli) {

            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            $preco = $_POST['preco'];

            $stmt = $mysqli->prepare("INSERT INTO produtos (nome, categoria, preco) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $nome, $categoria, $preco);        
            if ($stmt->execute()) {
                return "Produto cadastrado com sucesso!";
            } else {
                return "Erro ao cadastrar produto: " . $stmt->error;
            }
            $stmt->close();
        }
        return "";

    ?>