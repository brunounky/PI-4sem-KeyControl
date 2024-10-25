<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_admin = $_POST['nome_admin'];
    $email_admin = $_POST['email_admin'];
    $senha_admin = password_hash($_POST['senha_admin'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios_admin (nome_admin, email_admin, senha_admin) VALUES (:nome_admin, :email_admin, :senha_admin)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome_admin', $nome_admin);
    $stmt->bindParam(':email_admin', $email_admin);
    $stmt->bindParam(':senha_admin', $senha_admin);

    try {
        $stmt->execute();
        header("Location: ../../views/login_admin.html");
        exit();
    } catch (PDOException $e) {
        echo "Não foi possível cadastrar o administrador. Erro: " . $e->getMessage();
    }
} else {
    header("Location: cadastro_admin.html");
    exit();
}
?>
