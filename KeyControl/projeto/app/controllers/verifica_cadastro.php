<?php
require 'db_conexao.php'; //coloquei o caminho de outra forma no verifica login, testar a melor forma

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cnpj = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (id, nome, email, senha) VALUES (:id, :nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    try {
        $stmt->execute();
        header("Location: ../../views/login.html");
        exit();
    } catch (PDOException $e) {
        echo "Não foi possível cadastrar o usuário. Erro: " . $e->getMessage();
    }
} else {
    header("Location: cadastro_usuario.html");
    exit();
}
?>
