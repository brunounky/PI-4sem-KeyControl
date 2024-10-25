<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_admin = strtolower($_POST['email_admin']);
    $senha_admin = $_POST['senha_admin'];

    $sql = "SELECT * FROM usuarios_admin WHERE email_admin = :email_admin";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email_admin', $email_admin);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha_admin, $usuario['senha_admin'])) {
        session_start();
        $_SESSION['admin_id'] = $usuario['id'];
        $_SESSION['admin_nome'] = $usuario['nome_admin'];
        header("Location: ../../views/home_admin.php");
        exit();
    } else {
        header("Location: ../../views/login_admin.html?erro=1");
        exit();
    }
} else {
    header("Location: ../../views/login_admin.html");
    exit();
}