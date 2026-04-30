<?php
    require_once 'Conexao.php';

    function Listar_usuarios($mysqli) {
        $sql = "SELECT id, username, email, created_at FROM users";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['created_at']}</td>
                        <td><form method='POST' action=''><button name='remover_usuario' value='{$row['id']}' type='submit'>Remover</button></form></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
        }
    }
    function CriarUsuario($mysqli, $username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();
    }
    function RemoverUsuario($mysqli, $id) {
        $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
