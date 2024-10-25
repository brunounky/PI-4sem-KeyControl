<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO superior (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    try {
        $stmt->execute();
        header("Location: ../../views/login_superior.html");
        exit();
    } catch (PDOException $e) {
        echo "Não foi possível cadastrar o usuário. Erro: " . $e->getMessage();
    }
} else {
    header("Location: cadastro_superior.html");
    exit();
}
?>
